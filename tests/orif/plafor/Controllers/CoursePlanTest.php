<?php

namespace Plafor\Controllers;

// CodeIgniter looks for it in a specific location, which isn't disclosed anywhere.
// As such, I've decided to not waste time searching for it.
include_once __DIR__ . '/../Models/ModuleFabricator.php';
include_once __DIR__ . '/../Models/CoursePlanFabricator.php';

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\Fabricator;
use Plafor\Models\CoursePlanModel;
use Plafor\Models\CoursePlanModuleModel;
use Plafor\Models\ModuleModel;
use Tests\Support\Models\CoursePlanFabricator;
use Tests\Support\Models\ModuleFabricator;

/**
 * Tests for the CoursePlan controller
 */
class CoursePlanTest extends CIUnitTestCase
{
    use ControllerTestTrait, DatabaseTestTrait;

    /** @var Fabricator */
    private static $course_fabricator;
    /** @var Fabricator */
    private static $module_fabricator;

    protected $namespace = ['User', 'Plafor'];
    protected $refresh = TRUE;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$course_fabricator = new Fabricator(new CoursePlanFabricator());
        self::$module_fabricator = new Fabricator(new ModuleFabricator());
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
            if ($i <= 7) {
                $module['archive'] = NULL;
            }
            $module['module_number'] = str_pad($i, config('\Plafor\Config\PlaforConfig')->MODULE_NUMBER_MIN_LENGTH, '0', STR_PAD_LEFT);
            ModuleModel::getInstance()->insert($module);
        }
        ModuleModel::getInstance()->skipValidation(FALSE);

        // Insert dummy course plans
        CoursePlanModel::getInstance()->skipValidation(TRUE);
        foreach (self::$course_fabricator->make(5) as $i => $course_plan) {
            if ($i < 4) {
                $course_plan['archive'] = NULL;
            }
            $course_plan['formation_number'] = str_pad($i, config('\Plafor\Config\PlaforConfig')->FORMATION_NUMBER_MAX_LENGTH, '0', STR_PAD_LEFT);
            CoursePlanModel::getInstance()->insert($course_plan);
        }
        CoursePlanModel::getInstance()->skipValidation(FALSE);

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
     * Provider for testLinkModule
     *
     * @return array
     */
    public function linkModuleProvider(): array
    {
        return [
            'Display page' => [
                'course_plan_id' => 1,
                'post_data' => NULL,
                'expect_redirect' => FALSE,
                'expected_links' => 3,
            ],
            'Add link to module 4 as school' => [
                'course_plan_id' => 1,
                'post_data' => [
                    'modules_selected' => ['is_school:4'],
                ],
                'expect_redirect' => TRUE,
                'expected_links' => 4,
            ],
            'Add link to module 4 as not school' => [
                'course_plan_id' => 1,
                'post_data' => [
                    'modules_selected' => ['is_not_school:4'],
                ],
                'expect_redirect' => TRUE,
                'expected_links' => 4,
            ],
            'Remove link to module 3' => [
                'course_plan_id' => 1,
                'post_data' => [
                    'modules_selected' => ['no_link:3'],
                ],
                'expect_redirect' => TRUE,
                'expected_links' => 2,
            ],
            'Add link to inexistant module' => [
                'course_plan_id' => 1,
                'post_data' => [
                    'modules_selected' => ['is_school:999'],
                ],
                'expect_redirect' => TRUE,
                'expected_links' => 3,
            ],
            'Add link to module 4 with POST overrides parameter' => [
                'course_plan_id' => 999,
                'post_data' => [
                    'modules_selected' => ['is_school:4'],
                    'course_plan_id' => 1,
                ],
                'expect_redirect' => TRUE,
                'expected_links' => 0,
            ],
            'Fail adding link to inexistant course plan' => [
                'course_plan_id' => 999,
                'post_data' => [
                    'modules_selected' => ['is_school:3'],
                ],
                'expect_redirect' => TRUE,
                'expected_links' => 0,
            ],
            'Add link to archived course plan' => [
                'course_plan_id' => 4,
                'post_data' => [
                    'modules_selected' => ['is_school:3'],
                ],
                'expect_redirect' => TRUE,
                'expected_links' => 1,
            ],
        ];
    }

    /**
     * Tests CoursePlan::link_module
     *
     * @dataProvider linkModuleProvider
     * @group Apprentice
     * @group Modules
     * @group CoursePlans
     * @param  integer|null $course_plan_id ID of the course plan to try to link. If null, defaults to 0.
     * @param  array|null   $post_data Data to put into $_POST.
     * @param  boolean      $expect_redirect Whether a redirection is expected.
     * @param  integer      $expected_links Amount of modules expected to be linked to the course plan.
     * @return void
     */
    public function testLinkModule(?int $course_plan_id, ?array $post_data, bool $expect_redirect, int $expected_links): void
    {
        // Setup
        if (!empty($post_data)) {
            global $_POST;
            foreach ($post_data as $key => $value) {
                $_POST[$key] = $value;
            }
        }

        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/courseplan/link_module'))
            ->controller(\Plafor\Controllers\CoursePlan::class)
            ->execute('link_module', $course_plan_id);

        // Assert
        if ($expect_redirect) {
            $result->assertRedirect();
        } else {
            $result->assertNotRedirect();
        }

        $links = 0;
        if (!empty($linked_modules = CoursePlanModuleModel::getInstance()->where('fk_course_plan', $course_plan_id)->findAll())) {
            $links = count($linked_modules);
        }
        $this->assertEquals($expected_links, $links);
    }

    public function testLinkModuleMakeSchool(): void
    {
        // Setup
        $course_plan_id = 1;
        $link_id = CoursePlanModuleModel::getInstance()->insert([
            'fk_course_plan' => $course_plan_id,
            'fk_module' => 4,
            'is_school' => FALSE,
        ]);
        global $_POST;
        $_POST['modules_selected'] = ['is_school:4'];

        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/courseplan/link_module'))
            ->controller(\Plafor\Controllers\CoursePlan::class)
            ->execute('link_module', $course_plan_id);

        $result->assertRedirect();

        $data = CoursePlanModuleModel::getInstance()->find($link_id);
        $this->assertNotEmpty($data);
        $this->assertTrue($data['is_school'] == 1);
    }

    public function testLinkModuleUnschool(): void
    {
        // Setup
        $course_plan_id = 1;
        $link_id = CoursePlanModuleModel::getInstance()->insert([
            'fk_course_plan' => $course_plan_id,
            'fk_module' => 4,
            'is_school' => TRUE,
        ]);
        global $_POST;
        $_POST['modules_selected'] = ['is_not_school:4'];

        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/courseplan/link_module'))
            ->controller(\Plafor\Controllers\CoursePlan::class)
            ->execute('link_module', $course_plan_id);

        $result->assertRedirect();

        $data = CoursePlanModuleModel::getInstance()->find($link_id);
        $this->assertNotEmpty($data);
        $this->assertTrue($data['is_school'] == 0);
    }

    /**
     * Provider for testLinkModuleAccess
     *
     * @return array
     */
    public function linkModuleAccessProvider(): array
    {
        /** @var \Config\UserConfig */
        $user_config = config('\User\Config\UserConfig');

        return [
            'Not logged' => [
                'user_access' => NULL,
                'user_id' => NULL,
                'course_plan_id' => 1,
                'expect_redirect' => TRUE,
                'expect_403' => FALSE,
            ],
            'Apprentice can not link' => [
                'user_access' => $user_config->access_level_apprentice,
                'user_id' => 1,
                'course_plan_id' => 1,
                'expect_redirect' => FALSE,
                'expect_403' => TRUE,
            ],
            'Trainer can not link' => [
                'user_access' => $user_config->access_lvl_trainer,
                'user_id' => 3,
                'course_plan_id' => 1,
                'expect_redirect' => FALSE,
                'expect_403' => TRUE,
            ],
            'Admin can link' => [
                'user_access' => $user_config->access_lvl_admin,
                'user_id' => 5,
                'course_plan_id' => 1,
                'expect_redirect' => FALSE,
                'expect_403' => FALSE,
            ],
        ];
    }

    /**
     * Tests CoursePlan::link_module access
     *
     * @dataProvider linkModuleAccessProvider
     * @group Apprentice
     * @group Modules
     * @group CoursePlans
     * @param  integer|null $user_access Access to give to the "user", NULL if no access is set
     * @param  integer|null $user_id ID to give to the "user", NULL if no access is set
     * @param  integer      $course_plan_id ID of the course plan to get
     * @param  boolean      $expect_redirect Whether a redirection is expected
     * @param  boolean      $expect_403 Whether a 403 page is expected
     * @return void
     */
    public function testLinkModuleAccess(?int $user_access, ?int $user_id, int $course_plan_id, bool $expect_redirect, bool $expect_403): void
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
        $result = $this->withUri(base_url('plafor/courseplan/link_module'))
            ->controller(\Plafor\Controllers\CoursePlan::class)
            ->execute('link_module', $course_plan_id);

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
}
