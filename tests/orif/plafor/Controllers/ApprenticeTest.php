<?php

namespace Plafor\Controllers;

// CodeIgniter looks for it in a specific location, which isn't disclosed anywhere.
// As such, I've decided to not waste time searching for it.
include_once __DIR__ . '/../Models/ModuleFabricator.php';
include_once __DIR__ . '/../../user/Models/UserFabricator.php';
include_once __DIR__ . '/../Models/CoursePlanFabricator.php';

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\Fabricator;
use Plafor\Models\CoursePlanModel;
use Plafor\Models\CoursePlanModuleModel;
use Plafor\Models\ModuleModel;
use Plafor\Models\TrainerApprenticeModel;
use Plafor\Models\UserCourseModel;
use Plafor\Models\UserCourseModuleGradeModel as GradeModel;
use Tests\Support\Models\ModuleFabricator;
use Tests\Support\Models\UserFabricator;
use Tests\Support\Models\CoursePlanFabricator;
use User\Models\User_model;

/**
 * Tests for the Apprentice controller
 */
class ApprenticeTest extends CIUnitTestCase
{
    use ControllerTestTrait, DatabaseTestTrait;

    /** @var Fabricator */
    private static $user_fabricator;
    /** @var Fabricator */
    private static $course_fabricator;
    /** @var Fabricator */
    private static $module_fabricator;

    protected $namespace = ['User', 'Plafor'];
    protected $refresh = TRUE;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$module_fabricator = new Fabricator(new ModuleFabricator());
        self::$user_fabricator = new Fabricator(new UserFabricator());
        self::$course_fabricator = new Fabricator(new CoursePlanFabricator());
    }

    public function setUp(): void
    {
        parent::setUp();

        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;
        $_SESSION['logged_in'] = TRUE;
        $_SESSION['_ci_previous_url'] = base_url();

        // Insert dummy modules
        ModuleModel::getInstance()->skipValidation(TRUE);
        foreach (self::$module_fabricator->make(10) as $i => $module) {
            if ($i > 7) {
                $module['archive'] = '2022-01-01 00:00:00';
            }
            $module['module_number'] = str_pad($i, config('\Plafor\Config\PlaforConfig')->MODULE_NUMBER_MAX_LENGTH, '0', STR_PAD_LEFT);
            ModuleModel::getInstance()->insert($module);
        }
        ModuleModel::getInstance()->skipValidation(FALSE);

        // Insert dummy course plans
        CoursePlanModel::getInstance()->skipValidation(TRUE);
        foreach (self::$course_fabricator->make(5) as $i => $course_plan) {
            if ($i > 4) {
                $course_plan['archive'] = '2022-01-01 00:00:00';
            }
            $course_plan['formation_number'] = str_pad($i, config('\Plafor\Config\PlaforConfig')->FORMATION_NUMBER_MAX_LENGTH, '0', STR_PAD_LEFT);
            CoursePlanModel::getInstance()->insert($course_plan);
        }
        CoursePlanModel::getInstance()->skipValidation(FALSE);

        // Insert dummy users
        // Apprentices have IDs 1 and 2, trainers have IDs 3 and 4, and admins have IDs 5 and 6
        User_model::getInstance()->skipValidation(TRUE);
        foreach (self::$user_fabricator->make(6) as $i => $user) {
            $user['fk_user_type'] = 3 - intdiv($i, 2);
            User_model::getInstance()->insert($user);
        }
        User_model::getInstance()->skipValidation(FALSE);

        // Link dummy users and their trainers
        /** @var array<int,int> */
        $links = [
            3 => 1,
            4 => 2,
        ];
        TrainerApprenticeModel::getInstance()->skipValidation(TRUE);
        foreach ($links as $trainer_id => $apprentice_id) {
            TrainerApprenticeModel::getInstance()->insert([
                'fk_trainer' => $trainer_id,
                'fk_apprentice' => $apprentice_id,
            ]);
        }
        TrainerApprenticeModel::getInstance()->skipValidation(FALSE);

        // Link dummy users and dummy course plans
        /** @var array<int,int> */
        $links = [
            2 => 1,
            1 => 3,
        ];
        UserCourseModel::getInstance()->skipValidation(TRUE);
        foreach ($links as $user_id => $course_plan_id) {
            UserCourseModel::getInstance()->insert([
                'fk_user' => $user_id,
                'fk_course_plan' => $course_plan_id,
                'fk_status' => 1,
                'date_begin' => '2022-02-02',
                'date_end' => '0000-00-00',
            ]);
        }
        UserCourseModel::getInstance()->skipValidation(FALSE);

        // Link dummy course plans and dummy modules
        /** @var array<int,int[]> */
        $links = [
            1 => [1, 2, 3],
            2 => [1, 3, 5, 7],
            3 => [2, 4, 6],
        ];
        CoursePlanModuleModel::getInstance()->skipValidation(TRUE);
        foreach ($links as $course_plan_id => $modules_ids) {
            foreach ($modules_ids as $module_id) {
                CoursePlanModuleModel::getInstance()->insert([
                    'fk_course_plan' => $course_plan_id,
                    'fk_module' => $module_id,
                ]);
            }
        }
        CoursePlanModuleModel::getInstance()->skipValidation(FALSE);

        // Link dummy user course plans and dummy modules for grades
        /** @var array<int,array<int,float[]>> */
        $links = [
            1 => [
                1 => [4.0, 5.0],
                2 => [4.5],
                3 => [],
            ],
            2 => [
                2 => [6.0, 5.5],
                4 => [5.0, 3.5, 4.5],
                6 => [1.5],
            ],
        ];
        GradeModel::getInstance()->skipValidation(TRUE);
        foreach ($links as $user_course_id => $modules_grades) {
            foreach ($modules_grades as $module_id => $grades) {
                foreach ($grades as $grade) {
                    GradeModel::getInstance()->insert([
                        'fk_user_course' => $user_course_id,
                        'fk_module' => $module_id,
                        'grade' => $grade,
                    ]);
                }
            }
        }
        GradeModel::getInstance()->skipValidation(FALSE);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        // Clear POST data
        global $_POST;
        foreach ($_POST as $key => $v) {
            unset($_POST[$key]);
        }
    }

    /**
     * Provider for testListGradesAccess
     *
     * @return array
     */
    public function listGradesAccessProvider(): array
    {
        /** @var \Config\UserConfig */
        $user_config = config('\User\Config\UserConfig');

        return [
            'No access' => [
                'user_access' => NULL,
                'user_id' => NULL,
                'apprentice_id' => 1,
                'expect_redirect' => TRUE,
                'expect_403' => FALSE,
            ],
            // As an apprentice
            'Apprentice seeing own grades' => [
                'user_access' => $user_config->access_level_apprentice,
                'user_id' => 1,
                'apprentice_id' => 1,
                'expect_redirect' => FALSE,
                'expect_403' => FALSE,
            ],
            'Apprentice seeing other\'s grades does not fail' => [
                'user_access' => $user_config->access_level_apprentice,
                'user_id' => 1,
                'apprentice_id' => 2,
                'expect_redirect' => FALSE,
                'expect_403' => FALSE,
            ],
            'Apprentice seeing not apprentice\'s grades does not fail' => [
                'user_access' => $user_config->access_level_apprentice,
                'user_id' => 1,
                'apprentice_id' => 3,
                'expect_redirect' => FALSE,
                'expect_403' => FALSE,
            ],
            'Apprentice seeing inexistant user\'s grades does not fail' => [
                'user_access' => $user_config->access_level_apprentice,
                'user_id' => 1,
                'apprentice_id' => 9,
                'expect_redirect' => FALSE,
                'expect_403' => FALSE,
            ],
            // As a trainer
            'Trainer seeing own apprentice\'s grades' => [
                'user_access' => $user_config->access_lvl_trainer,
                'user_id' => 3,
                'apprentice_id' => 1,
                'expect_redirect' => FALSE,
                'expect_403' => FALSE,
            ],
            'Trainer not seeing other apprentice\'s grades' => [
                'user_access' => $user_config->access_lvl_trainer,
                'user_id' => 3,
                'apprentice_id' => 2,
                'expect_redirect' => TRUE,
                'expect_403' => FALSE,
            ],
            'Trainer not seeing not apprentice\'s grades' => [
                'user_access' => $user_config->access_lvl_trainer,
                'user_id' => 3,
                'apprentice_id' => 3,
                'expect_redirect' => TRUE,
                'expect_403' => FALSE,
            ],
            'Trainer not seeing inexistant user\'s grades' => [
                'user_access' => $user_config->access_lvl_trainer,
                'user_id' => 3,
                'apprentice_id' => 9,
                'expect_redirect' => TRUE,
                'expect_403' => FALSE,
            ],
            // As an admin
            'Admin seeing apprentice 1\'s grades' => [
                'user_access' => $user_config->access_lvl_admin,
                'user_id' => 5,
                'apprentice_id' => 1,
                'expect_redirect' => FALSE,
                'expect_403' => FALSE,
            ],
            'Admin seeing apprentice 2\'s grades' => [
                'user_access' => $user_config->access_lvl_admin,
                'user_id' => 5,
                'apprentice_id' => 2,
                'expect_redirect' => FALSE,
                'expect_403' => FALSE,
            ],
            'Admin not seeing not apprentice\'s grades' => [
                'user_access' => $user_config->access_lvl_trainer,
                'user_id' => 5,
                'apprentice_id' => 3,
                'expect_redirect' => TRUE,
                'expect_403' => FALSE,
            ],
            'Admin not seeing inexistant user\'s grades' => [
                'user_access' => $user_config->access_lvl_trainer,
                'user_id' => 5,
                'apprentice_id' => 9,
                'expect_redirect' => TRUE,
                'expect_403' => FALSE,
            ],
        ];
    }

    /**
     * Tests Apprentice::list_grades access
     *
     * @dataProvider listGradesAccessProvider
     * @group Grades
     * @param  integer|null $user_access Access given to the "user", NULL if no access is set.
     * @param  integer|null $user_id ID given to the "user", NULL if no access is set.
     * @param  integer      $apprentice_id ID of the apprentice to get
     * @param  boolean      $expect_redirect Whether redirection is expected
     * @param  boolean      $expect_403 Whether a 403 page is expected
     * @return void
     */
    public function testListGradesAccess(?int $user_access, ?int $user_id, int $apprentice_id, bool $expect_redirect, bool $expect_403): void
    {
        // Setup
        if (is_null($user_access) || is_null($user_id)) {
            session()->remove('user_access');
            session()->remove('logged_in');
            session()->remove('user_id');
        } else {
            session()->set('user_access', $user_access);
            session()->set('logged_in', TRUE);
            session()->set('user_id', $user_id);
        }

        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/apprentice/list_grades'))
            ->controller(\Plafor\Controllers\Apprentice::class)
            ->execute('list_grades', $apprentice_id);

        // Assert
        if ($expect_redirect) {
            $result->assertRedirect();
        } else {
            $result->assertNotRedirect();

            if ($expect_403) {
                $result->assertSee('403');
            } else {
                $result->assertDontSee('403');
            }
        }
    }

    /**
     * Provider for testAddGrade
     *
     * @return array
     */
    public function addGradeProvider(): array
    {
        /** @var \Config\PlaforConfig */
        $plafor_config = config('\Plafor\Config\PlaforConfig');

        return [
            // Just display
            'Display existing link 1' => [
                'user_course_id' => 1,
                'module_id' => 1,
                'post_data' => NULL,
                'expect_redirect' => FALSE,
                'expect_errors' => FALSE,
            ],
            'Display existing link 2' => [
                'user_course_id' => 1,
                'module_id' => 2,
                'post_data' => NULL,
                'expect_redirect' => FALSE,
                'expect_errors' => FALSE,
            ],
            // Insert
            'Insert new grade' => [
                'user_course_id' => 1,
                'module_id' => 1,
                'post_data' => [
                    'grade' => 1.3,
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
            // Insert with POST data
            'Insert with POST module id' => [
                'user_course_id' => 1,
                'module_id' => NULL,
                'post_data' => [
                    'grade' => 1.5,
                    'module_id' => 1,
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
            'Insert with POST user course id' => [
                'user_course_id' => NULL,
                'module_id' => 1,
                'post_data' => [
                    'grade' => 3.3,
                    'user_course_id' => 1,
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
            'Insert with POST module id and user course id' => [
                'user_course_id' => NULL,
                'module_id' => NULL,
                'post_data' => [
                    'grade' => 3.5,
                    'user_course_id' => 1,
                    'module_id' => 1,
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
            // Insert with POST data that overrides invalid data
            'Insert with POST module id overrides parameter' => [
                'user_course_id' => 1,
                'module_id' => 999,
                'post_data' => [
                    'grade' => 1.5,
                    'module_id' => 1,
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
            'Insert with POST user course id overrides parameter' => [
                'user_course_id' => 999,
                'module_id' => 1,
                'post_data' => [
                    'grade' => 3.3,
                    'user_course_id' => 1,
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
            'Insert with POST module id and user course id overrides parameters' => [
                'user_course_id' => 999,
                'module_id' => 999,
                'post_data' => [
                    'grade' => 3.5,
                    'user_course_id' => 1,
                    'module_id' => 1,
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
            // Insert invalid data
            'Insert with grade too low' => [
                'user_course_id' => 1,
                'module_id' => 1,
                'post_data' => [
                    'grade' => $plafor_config->GRADE_LOWEST - 1,
                ],
                'expect_redirect' => FALSE,
                'expect_errors' => TRUE,
            ],
            'Insert with grade too high' => [
                'user_course_id' => 1,
                'module_id' => 1,
                'post_data' => [
                    'grade' => $plafor_config->GRADE_HIGHEST + 1,
                ],
                'expect_redirect' => FALSE,
                'expect_errors' => TRUE,
            ],
        ];
    }

    /**
     * Tests Apprentice::add_grade
     *
     * @dataProvider addGradeProvider
     * @group Grades
     * @param  integer|null $user_course_id ID of the user course to pass. If null, defaults to 0
     * @param  integer|null $module_id ID of the module to pass. If null, defaults to 0
     * @param  array|null   $post_data Data to put in $_POST. If null, $_POST is emptied
     * @param  boolean      $expect_redirect Whether redirection is expected
     * @param  boolean      $expect_errors Whether validation errors are expected. Automatically false if redirection is expected
     * @return void
     */
    public function testAddGrade(?int $user_course_id, ?int $module_id, ?array $post_data, bool $expect_redirect, bool $expect_errors): void
    {
        // Setup
        $user_course_id ??= 0;
        $module_id ??= 0;
        global $_POST;
        $keys = ['user_course_id', 'module_id', 'grade'];
        foreach ($keys as $key) {
            if (!is_null($post_data) && array_key_exists($key, $post_data)) {
                $_POST[$key] = $post_data[$key];
            }
        }
        // Reset errors by removing the existing instance
        (new \ReflectionClass(GradeModel::class))->setStaticPropertyValue('userCourseModuleGradeModel', null);

        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/apprentice/add_grade'))
            ->controller(\Plafor\Controllers\Apprentice::class)
            ->execute('add_grade', $user_course_id, $module_id);

        // Assert
        if ($expect_redirect) {
            $this->assertEmpty(GradeModel::getInstance()->errors());
            $result->assertRedirect();
        } else {
            $result->assertNotRedirect();

            $errors = GradeModel::getInstance()->errors();
            if ($expect_errors) {
                $this->assertNotEmpty($errors);
            } else {
                $this->assertEmpty($errors);
            }
        }
    }

    /**
     * Provider for testEditGrade
     *
     * @return array
     */
    public function editGradeProvider(): array
    {
        /** @var \Config\PlaforConfig */
        $plafor_config = config('\Plafor\Config\PlaforConfig');

        return [
            // Just display
            'Display existing grade 1' => [
                'grade_id' => 1,
                'post_data' => NULL,
                'expect_redirect' => FALSE,
                'expect_errors' => FALSE,
            ],
            'Display existing grade 3' => [
                'grade_id' => 3,
                'post_data' => NULL,
                'expect_redirect' => FALSE,
                'expect_errors' => FALSE,
            ],
            // Update
            'Update grade' => [
                'grade_id' => 1,
                'post_data' => [
                    'grade' => 1.4,
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
            // Update with POST data
            'Update with POST grade id' => [
                'grade_id' => NULL,
                'post_data' => [
                    'grade_id' => 1,
                    'grade' => 1.5,
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
            // Update with POST data that overrides invalid data
            'Update with POST grade id overrides parameter' => [
                'grade_id' => 999,
                'post_data' => [
                    'grade_id' => 1,
                    'grade' => 1.6,
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
            // Update invalid data
            'Update with grade too low' => [
                'grade_id' => 1,
                'post_data' => [
                    'grade' => $plafor_config->GRADE_LOWEST - 1,
                ],
                'expect_redirect' => FALSE,
                'expect_errors' => TRUE,
            ],
            'Update with grade too high' => [
                'grade_id' => 1,
                'post_data' => [
                    'grade' => $plafor_config->GRADE_HIGHEST + 1,
                ],
                'expect_redirect' => FALSE,
                'expect_errors' => TRUE,
            ],
            'Update with inexistant grade' => [
                'grade_id' => 999,
                'post_data' => [
                    'grade' => 1,
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
        ];
    }

    /**
     * Tests Apprentice::edit_grade
     *
     * @dataProvider editGradeProvider
     * @group Grades
     * @param  integer|null $grade_id ID of the grade to edit. If null, defaults to 0
     * @param  array|null   $post_data Data to put in $_POST. If null, $_POST is emptied
     * @param  boolean      $expect_redirect Whether redirection is expected
     * @param  boolean      $expect_errors Whether validation errors are expected. Automatically false if redirection is expected
     * @return void
     */
    public function testEditGrade(?int $grade_id, ?array $post_data, bool $expect_redirect, bool $expect_errors): void
    {
        // Setup
        $grade_id ??= 0;
        global $_POST;
        $keys = ['grade_id', 'grade'];
        foreach ($keys as $key) {
            if (!is_null($post_data) && array_key_exists($key, $post_data)) {
                $_POST[$key] = $post_data[$key];
            }
        }
        // Reset errors by removing the existing instance
        (new \ReflectionClass(GradeModel::class))->setStaticPropertyValue('userCourseModuleGradeModel', null);

        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/apprentice/edit_grade'))
            ->controller(\Plafor\Controllers\Apprentice::class)
            ->execute('edit_grade', $grade_id);

        // Assert
        if ($expect_redirect) {
            $this->assertEmpty(GradeModel::getInstance()->errors());
            $result->assertRedirect();
        } else {
            $result->assertNotRedirect();

            $errors = GradeModel::getInstance()->errors();
            if ($expect_errors) {
                $this->assertNotEmpty($errors);
            } else {
                $this->assertEmpty($errors);
            }
        }
    }

    /**
     * Provider for testEditGradeAccess
     *
     * @return array
     */
    public function editGradeAccessProvider(): array
    {
        /** @var \Config\UserConfig */
        $user_config = config('\User\Config\UserConfig');

        return [
            // No access
            'Not logged' => [
                'user_access' => NULL,
                'user_id' => NULL,
                'grade_id' => 1,
                'expect_redirect' => TRUE,
                'expect_403' => FALSE,
            ],
            // Apprentice access
            'Apprentice cannot access grade 1' => [
                'user_access' => $user_config->access_level_apprentice,
                'user_id' => 1,
                'grade_id' => 1,
                'expect_redirect' => FALSE,
                'expect_403' => TRUE,
            ],
            'Apprentice cannot access grade 3' => [
                'user_access' => $user_config->access_level_apprentice,
                'user_id' => 1,
                'grade_id' => 3,
                'expect_redirect' => FALSE,
                'expect_403' => TRUE,
            ],
            'Apprentice cannot access inexistant grade' => [
                'user_access' => $user_config->access_level_apprentice,
                'user_id' => 1,
                'grade_id' => 99,
                'expect_redirect' => FALSE,
                'expect_403' => TRUE,
            ],
            // Trainer
            'Trainer can access own apprentice\'s grade' => [
                'user_access' => $user_config->access_lvl_trainer,
                'user_id' => 4,
                'grade_id' => 1,
                'expect_redirect' => FALSE,
                'expect_403' => FALSE,
            ],
            'Trainer cannot access other apprentice\'s grade' => [
                'user_access' => $user_config->access_lvl_trainer,
                'user_id' => 4,
                'grade_id' => 7,
                'expect_redirect' => TRUE,
                'expect_403' => FALSE,
            ],
            'Trainer cannot access inexistant grade' => [
                'user_access' => $user_config->access_lvl_trainer,
                'user_id' => 3,
                'grade_id' => 99,
                'expect_redirect' => TRUE,
                'expect_403' => FALSE,
            ],
            // Admin
            'Admin can access apprentice 1\'s grade' => [
                'user_access' => $user_config->access_lvl_admin,
                'user_id' => 5,
                'grade_id' => 7,
                'expect_redirect' => FALSE,
                'expect_403' => FALSE,
            ],
            'Admin can access apprentice 2\'s grade' => [
                'user_access' => $user_config->access_lvl_admin,
                'user_id' => 5,
                'grade_id' => 1,
                'expect_redirect' => FALSE,
                'expect_403' => FALSE,
            ],
            'Admin cannot access inexistant grade' => [
                'user_access' => $user_config->access_lvl_admin,
                'user_id' => 5,
                'grade_id' => 99,
                'expect_redirect' => TRUE,
                'expect_403' => FALSE,
            ],
        ];
    }

    /**
     * Tests Apprentice::edit_grade access
     *
     * @dataProvider editGradeAccessProvider
     * @group Grades
     * @param  integer|null $user_access Access given to the "user", NULL if no access is set.
     * @param  integer|null $user_id ID given to the "user", NULL if no access is set.
     * @param  integer      $grade_id ID of the grade to get
     * @param  boolean      $expect_redirect Whether redirection is expected
     * @param  boolean      $expect_403 Whether a 403 page is expected
     * @return void
     */
    public function testEditGradeAccess(?int $user_access, ?int $user_id, int $grade_id, bool $expect_redirect, bool $expect_403): void
    {
        // Setup
        if (is_null($user_access) || is_null($user_id)) {
            session()->remove('user_access');
            session()->remove('logged_in');
            session()->remove('user_id');
        } else {
            session()->set('user_access', $user_access);
            session()->set('logged_in', TRUE);
            session()->set('user_id', $user_id);
        }

        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/apprentice/edit_grade'))
            ->controller(\Plafor\Controllers\Apprentice::class)
            ->execute('edit_grade', $grade_id);

        // Assert
        if ($expect_redirect) {
            $result->assertRedirect();
        } else {
            $result->assertNotRedirect();

            if ($expect_403) {
                $result->assertSee('403');
            } else {
                $result->assertDontSee('403');
            }
        }
    }

    /**
     * Provider for testDeleteGrade
     *
     * @return array
     */
    public function deleteGradeProvider() : array
    {
        return [
            'Show grade delete confirmation' => [
                'grade_id' => 1,
                'action' => 0,
                'expect_redirect' => FALSE,
                'exists' => TRUE,
            ],
            'Delete grade' => [
                'grade_id' => 1,
                'action' => 1,
                'expect_redirect' => TRUE,
                'exists' => FALSE,
            ],
            'Do not show inexistant grade' => [
                'grade_id' => 999,
                'action' => NULL,
                'expect_redirect' => TRUE,
                'exists' => FALSE,
            ],
            'Do nothing on invalid action' => [ //?!
                'grade_id' => 1,
                'action' => 999,
                'expect_redirect' => TRUE,
                'exists' => TRUE,
            ],
        ];
    }

    /**
     * Tests for Apprentice::delete_grade
     *
     * @dataProvider deleteGradeProvider
     * @group Grades
     * @param  integer      $grade_id ID of the grade to delete
     * @param  integer|null $action Action passed. If null, defaults to 0.
     * @param  boolean      $expect_redirect Whether a redirect is expected
     * @param  boolean      $exists Whether the grade exists afterwards
     * @return void
     */
    public function testDeleteGrade(int $grade_id, ?int $action, bool $expect_redirect, bool $exists): void
    {
        // Setup
        $action ??= 0;

        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/apprentice/delete_grade'))
            ->controller(\Plafor\Controllers\Apprentice::class)
            ->execute('delete_grade', $grade_id, $action);

        // Assert
        if ($expect_redirect) {
            $result->assertRedirect();
        } else {
            $result->assertNotRedirect();
        }

        $data = GradeModel::getInstance()->withDeleted()->find($grade_id);
        if (!$exists) {
            $this->assertEmpty($data);
        } else {
            $this->assertNotEmpty($data);
        }
    }
}
