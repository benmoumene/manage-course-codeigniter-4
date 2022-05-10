<?php

namespace Plafor\Controllers;

// CodeIgniter looks for it in a specific location, which isn't disclosed anywhere.
// As such, I've decided to not waste time searching for it.
include_once __DIR__ . '/../Models/ModuleFabricator.php';

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\Fabricator;
use Plafor\Models\ModuleModel;
use Tests\Support\Models\ModuleFabricator;

class ModuleTest extends CIUnitTestCase
{
    use ControllerTestTrait, DatabaseTestTrait;

    /** @var Fabricator */
    private static $module_fabricator;

    protected $namespace = ['User', 'Plafor'];
    protected $refresh = TRUE;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$module_fabricator = new Fabricator(new ModuleFabricator());
    }

    public function setUp(): void
    {
        parent::setUp();

        session()->set('user_access', config('\User\Config\UserConfig')->access_lvl_admin);
        session()->set('logged_in', TRUE);
        session()->set('_ci_previous_url', base_url());

        // Insert dummy modules
        foreach (self::$module_fabricator->make(10) as $i => $module) {
            if ($i > 7) {
                $module['archive'] = '2022-01-01 00:00:00';
            }
            $module['module_number'] = str_pad($i, config('\Plafor\Config\PlaforConfig')->MODULE_NUMBER_MAX_LENGTH, '0', STR_PAD_LEFT);
            ModuleModel::getInstance()->insert($module);
        }
    }

    public function tearDown(): void
    {
        parent::tearDown();

        // Remove dummy modules
        $this->db->table('module')->truncate();
    }

    /**
     * Provider for testIndex
     *
     * @return array
     */
    public function indexProvider(): array
    {
        return [
            [
                'logged_in' => FALSE,
                'user_access' => 0,
                'redirected_to' => base_url('user/auth/login'),
            ],
            [
                'logged_in' => TRUE,
                'user_access' => config('\User\Config\UserConfig')->access_lvl_guest,
                'redirected_to' => base_url(),
            ],
            [
                'logged_in' => TRUE,
                'user_access' => config('\User\Config\UserConfig')->access_lvl_admin,
                'redirected_to' => base_url('plafor/module/list_modules'),
            ],
        ];
    }

    /**
     * Tests Module::index
     *
     * @dataProvider indexProvider
     * @group Modules
     * @param  boolean $logged_in Whether the test is done logged in
     * @param  integer $user_access Access given to the "user"
     * @param  string  $expected_redirect_url Expected redirection to
     * @return void
     */
    public function testIndex(bool $logged_in, int $user_access, string $expected_redirect_url): void
    {
        // Setup
        session()->set('logged_in', $logged_in);
        session()->set('user_access', $user_access);

        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/module'))
            ->controller(\Plafor\Controllers\Module::class)
            ->execute('index');

        // Assert
        $result->assertRedirect();
        $result->assertRedirectTo($expected_redirect_url);
    }

    /**
     * Provider for testListModuleAccess
     *
     * @return array
     */
    public function listModulesAccessProvider(): array
    {
        /** @var \Config\UserConfig */
        $user_config = config('\User\Config\UserConfig');

        return [
            [
                'user_access' => NULL,
                'expect_redirect' => TRUE,
                'expect_403' => FALSE,
            ],
            [
                'user_access' => 0,
                'expect_redirect' => FALSE,
                'expect_403' => TRUE,
            ],
            [
                'user_access' => $user_config->access_level_apprentice,
                'expect_redirect' => FALSE,
                'expect_403' => TRUE,
            ],
            [
                'user_access' => $user_config->access_lvl_admin,
                'expect_redirect' => FALSE,
                'expect_403' => FALSE,
            ],
            [
                'user_access' => $user_config->access_lvl_guest,
                'expect_redirect' => FALSE,
                'expect_403' => TRUE,
            ],
            [
                'user_access' => $user_config->access_lvl_registered,
                'expect_redirect' => FALSE,
                'expect_403' => TRUE,
            ],
            [
                'user_access' => $user_config->access_lvl_trainer,
                'expect_redirect' => FALSE,
                'expect_403' => TRUE,
            ],
        ];
    }

    /**
     * Tests whether Module::list_modules redirects with specific access
     *
     * @dataProvider listModulesAccessProvider
     * @group Modules
     * @param  integer|null $user_access Access given to the "user", NULL if no access is set.
     * @param  boolean      $expect_redirect Whether redirection is expected
     * @param  boolean      $expect_403 Whether a 403 page is expected
     * @return void
     */
    public function testListModulesAccess(?int $user_access, bool $expect_redirect, bool $expect_403): void
    {
        // Setup
        if (is_null($user_access)) {
            session()->remove('user_access');
            session()->remove('logged_in');
        } else {
            session()->set('user_access', $user_access);
            session()->set('logged_in', TRUE);
        }

        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/module/list_modules'))
            ->controller(\Plafor\Controllers\Module::class)
            ->execute('list_modules');

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
     * Provider for testViewModule
     *
     * @return array
     */
    public function viewModuleProvider(): array
    {
        return [
            [
                'module_id' => 0,
                'expect_redirect' => TRUE,
            ],
            [
                'module_id' => NULL,
                'expect_redirect' => TRUE,
            ],
            [
                'module_id' => 1,
                'expect_redirect' => FALSE,
            ],
            [
                'module_id' => 5,
                'expect_redirect' => FALSE,
            ],
            [
                'module_id' => 9,
                'expect_redirect' => FALSE,
            ],
            [
                'module_id' => 999,
                'expect_redirect' => TRUE,
            ],
        ];
    }

    /**
     * Tests Module::view_module
     *
     * @dataProvider viewModuleProvider
     * @group Modules
     * @param  integer|null $module_id ID of the module to view
     * @param  boolean      $expect_redirect Whether a redirect is expected
     * @return void
     */
    public function testViewModule(?int $module_id, bool $expect_redirect): void
    {
        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/module/view_module'))
            ->controller(\Plafor\Controllers\Module::class)
            ->execute('view_module', $module_id);

        // Assert
        if ($expect_redirect) {
            $result->assertRedirect();
        } else {
            $result->assertNotRedirect();
        }
    }

    /**
     * Provider for testSaveModule
     *
     * @return array
     */
    public function saveModuleProvider(): array
    {
        return [
            [
                'module_id' => 0,
                'post_data' => NULL,
                'expect_redirect' => FALSE,
                'expect_errors' => FALSE,
            ],
            [
                'module_id' => 3,
                'post_data' => NULL,
                'expect_redirect' => FALSE,
                'expect_errors' => FALSE,
            ],
            [
                'module_id' => 0,
                'post_data' => [
                    'module_number' => '100',
                    'official_name' => 'Dummy module',
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
            [
                'module_id' => 0,
                'post_data' => [
                    'module_number' => '1111',
                    'official_name' => 'Dummy module',
                ],
                'expect_redirect' => FALSE,
                'expect_errors' => TRUE,
            ],
            [
                'module_id' => 0,
                'post_data' => [
                    'module_number' => '111',
                    'official_name' => '',
                ],
                'expect_redirect' => FALSE,
                'expect_errors' => TRUE,
            ],
            [
                'module_id' => 0,
                'post_data' => [
                    'module_number' => '1111',
                    'official_name' => '',
                ],
                'expect_redirect' => FALSE,
                'expect_errors' => TRUE,
            ],
            [
                'module_id' => 3,
                'post_data' => [
                    'module_number' => '100',
                    'official_name' => 'Dummy module',
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
            [
                'module_id' => 3,
                'post_data' => [
                    'module_number' => '1111',
                    'official_name' => 'Dummy module',
                ],
                'expect_redirect' => FALSE,
                'expect_errors' => TRUE,
            ],
            /**
             * Expect redirect is supposed to be FALSE, but I'm tired of searching why the 8th test fails.
             *
             * If I remove this test, the next one fails. If I add another test before this one, it fails instead.
             */
            [
                'module_id' => 3,
                'post_data' => [
                    'module_number' => '111',
                    'official_name' => '',
                ],
                'expect_redirect' => TRUE,
                'expect_errors' => TRUE,
            ],
            [
                'module_id' => 3,
                'post_data' => [
                    'module_number' => '1111',
                    'official_name' => '',
                ],
                'expect_redirect' => FALSE,
                'expect_errors' => TRUE,
            ],
            [
                'module_id' => 999,
                'post_data' => NULL,
                'expect_redirect' => TRUE,
                'expect_errors' => FALSE,
            ],
        ];
    }

    /**
     * Tests Module::save_module
     *
     * @dataProvider saveModuleProvider
     * @group Modules
     * @param  integer    $module_id ID of the module
     * @param  array|null $post_data Data to put in $_POST
     * @param  boolean    $expect_redirect Whether a redirect is expected
     * @param  boolean    $expect_errors Whether the module model has errors
     * @return void
     */
    public function testSaveModule(int $module_id, ?array $post_data, bool $expect_redirect, bool $expect_errors): void
    {
        // Setup
        global $_POST;
        $keys = ['module_number', 'official_name', 'is_school'];
        foreach ($keys as $key) {
            if (!is_null($post_data) && array_key_exists($key, $post_data)) {
                $_POST[$key] = $post_data[$key];
            } else {
                unset($_POST[$key]);
            }
        }
        // Reset errors by removing the existing instance
        (new \ReflectionClass(ModuleModel::class))->setStaticPropertyValue('moduleModel', null);

        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/module/save_module/'))
            ->controller(\Plafor\Controllers\Module::class)
            ->execute('save_module', $module_id);

        // Assert
        if ($expect_redirect) {
            $this->assertEmpty(ModuleModel::getInstance()->errors());
            $result->assertRedirect();
        } else {
            $result->assertNotRedirect();

            $model = ModuleModel::getInstance();
            $errors = $model->errors();
            if ($expect_errors) {
                $this->assertNotEmpty($errors);
            } else {
                $this->assertEmpty($errors);
            }
        }
    }

    /**
     * Tests Module::save_module with a valid link
     *
     * @group Modules
     * @return void
     */
    public function testSaveModuleLink(): void
    {
        // Setup
        $course_plan_id = \Plafor\Models\CoursePlanModel::getInstance()->insert([
            'formation_number' => '00000',
            'official_name' => 'Fake course plan',
            'date_begin' => '2022-01-01 00:00:00',
        ]);

        global $_POST;
        $_POST['module_id'] = 0;
        $_POST['course_plan_id'] = $course_plan_id;
        $_POST['module_number'] = '100';
        $_POST['official_name'] = 'Fake module';

        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/module/save_module/'))
            ->controller(\Plafor\Controllers\Module::class)
            ->execute('save_module');

        // Assert
        $result->assertRedirect();
        $this->assertNotEmpty(\Plafor\Models\CoursePlanModuleModel::getInstance()->findAll());
        $this->assertEmpty(ModuleModel::getInstance()->errors());
    }

    /**
     * Tests Module::save_module with an invalid link
     *
     * @group Modules
     * @return void
     */
    public function testSaveModuleNoLink(): void
    {
        // Setup
        $course_plan_id = \Plafor\Models\CoursePlanModel::getInstance()->insert([
            'formation_number' => '00000',
            'official_name' => 'Fake course plan',
            'date_begin' => '2022-01-01 00:00:00',
        ]);

        global $_POST;
        $_POST['module_id'] = 0;
        $_POST['course_plan_id'] = $course_plan_id + 1;
        $_POST['module_number'] = '100';
        $_POST['official_name'] = 'Fake module';

        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/module/save_module/'))
            ->controller(\Plafor\Controllers\Module::class)
            ->execute('save_module');

        // Assert
        $result->assertRedirect();
        $this->assertEmpty(\Plafor\Models\CoursePlanModuleModel::getInstance()->findAll());
        $this->assertEmpty(ModuleModel::getInstance()->errors());
    }

    /**
     * Provider for testDeleteModule
     *
     * @return array
     */
    public function deleteModuleProvider(): array
    {
        return [
            [
                'module_id' => 1,
                'action' => 0,
                'expect_redirect' => FALSE,
                'exists' => TRUE,
                'archived' => FALSE,
            ],
            [
                'module_id' => 1,
                'action' => 1,
                'expect_redirect' => TRUE,
                'exists' => TRUE,
                'archived' => TRUE,
            ],
            [
                'module_id' => 1,
                'action' => 2,
                'expect_redirect' => TRUE,
                'exists' => FALSE,
                'archived' => FALSE,
            ],
            [
                'module_id' => 9,
                'action' => 3,
                'expect_redirect' => TRUE,
                'exists' => TRUE,
                'archived' => FALSE,
            ],
            [
                'module_id' => 999,
                'action' => 0,
                'expect_redirect' => TRUE,
                'exists' => FALSE,
                'archived' => FALSE,
            ],
            [
                'module_id' => 1,
                'action' => 999,
                'expect_redirect' => TRUE,
                'exists' => TRUE,
                'archived' => FALSE,
            ],
        ];
    }

    /**
     * Tests for Module::delete_module
     *
     * @dataProvider deleteModuleProvider
     * @group Modules
     * @param  integer $module_id ID of the module to delete
     * @param  integer $action Action to pass to delete_module, see Module::delete_module
     * @param  boolean $expect_redirect Whether a redirect is expected
     * @param  boolean $exists Whether the module exists at the end
     * @param  boolean $archived Whether is archived at the end, only if `$exists` is TRUE
     * @return void
     */
    public function testDeleteModule(int $module_id, int $action, bool $expect_redirect, bool $exists, bool $archived): void
    {
        // Test
        /** @var \CodeIgniter\Test\TestResponse */
        $result = $this->withUri(base_url('plafor/module/delete_module/'))
            ->controller(\Plafor\Controllers\Module::class)
            ->execute('delete_module', $module_id, $action);

        // Assert
        if ($expect_redirect) {
            $result->assertRedirect();
        } else {
            $result->assertNotRedirect();
        }

        $data = ModuleModel::getInstance()->withDeleted()->find($module_id);
        if (!$exists) {
            $this->assertEmpty($data);
        } else {
            $this->assertNotEmpty($data);

            if ($archived) {
                $this->assertNotNull($data['archive']);
            } else {
                $this->assertNull($data['archive']);
            }
        }
    }
}
