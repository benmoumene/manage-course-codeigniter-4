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
            $module['module_number'] = str_pad($i, config('\Plafor\Config\PlaforConfig')->MODULE_NUMBER_MAX_LENGTH, '0', STR_PAD_LEFT);
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
            'Add link to module 4' => [
                'course_plan_id' => 1,
                'post_data' => [
                    'modules_selected' => [1, 2, 3, 4],
                ],
                'expect_redirect' => TRUE,
                'expected_links' => 4,
            ],
            'Remove link to module 3' => [
                'course_plan_id' => 1,
                'post_data' => [
                    'modules_selected' => [1, 2],
                ],
                'expect_redirect' => TRUE,
                'expected_links' => 2,
            ],
            'Add link to inexistant module' => [
                'course_plan_id' => 1,
                'post_data' => [
                    'modules_selected' => [1, 2, 3, 999],
                ],
                'expect_redirect' => TRUE,
                'expected_links' => 3,
            ],
            'Add link to module 4 with POST overrides parameter' => [
                'course_plan_id' => 999,
                'post_data' => [
                    'modules_selected' => [1, 2, 3, 4],
                    'course_plan_id' => 1,
                ],
                'expect_redirect' => TRUE,
                'expected_links' => 0,
            ],
            'Fail adding link to inexistant course plan' => [
                'course_plan_id' => 999,
                'post_data' => [
                    'modules_selected' => [1, 2, 3],
                ],
                'expect_redirect' => TRUE,
                'expected_links' => 0,
            ],
            'Add link to archived course plan' => [
                'course_plan_id' => 4,
                'post_data' => [
                    'modules_selected' => [1, 2, 3],
                ],
                'expect_redirect' => TRUE,
                'expected_links' => 3,
            ],
        ];
    }

    /**
     * Tests CoursePlan::link_module
     *
     * @group Apprentice
     * @group Modules
     * @dataProvider linkModuleProvider
     * @param  integer|null $course_plan_id ID of the course plan to try to link. If null, defaults to 0.
     * @param  array|null   $post_data Data to put into $_POST.
     * @param  boolean      $expect_redirect Whether a redirection is expected.
     * @param  integer      $expected_links Amount of modules expected to be linked to the course plan.
     * @return void
     */
    public function testLinkModule(?int $course_plan_id, ?array $post_data, bool $expect_redirect, int $expected_links): void
    {
        // Setup
        if (!is_null($post_data)) {
            global $_POST;
            $keys = ['course_plan_id', 'modules_selected'];
            foreach ($keys as $key) {
                if (!is_null($post_data) && array_key_exists($key, $post_data)) {
                    $_POST[$key] = $post_data[$key];
                }
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
}
