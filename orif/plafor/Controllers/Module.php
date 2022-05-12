<?php

namespace Plafor\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Plafor\Models\CoursePlanModel;
use Plafor\Models\CoursePlanModuleModel;
use Plafor\Models\ModuleModel;
use Psr\Log\LoggerInterface;

class Module extends \App\Controllers\BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        $this->access_level = "@";
        parent::initController($request, $response, $logger);
    }

    public function index()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
            if ($_SESSION['user_access'] >= config('\User\Config\UserConfig')->access_lvl_admin) {
                return redirect()->to(base_url('plafor/module/list_modules'));
            } else {
                return redirect()->to(base_url());
            }
        } else {
            // No session is set, redirect to login page
            return redirect()->to(base_url('user/auth/login'));
        }
    }

    /**
     * Displays the list of modules
     *
     * @param  boolean $with_archived If true, archived modules are also shown
     * @return void
     */
    public function list_modules(bool $with_archived = false)
    {
        if (!isset($_SESSION['user_access']) || $_SESSION['user_access'] < config('\User\Config\UserConfig')->access_lvl_admin) {
            return $this->display_view('\User\errors\403error');
        }

        $data = [
            'title' => lang('plafor_lang.title_module_list'),
            'with_archived' => $with_archived,
            'modules' => ModuleModel::getInstance()->withDeleted($with_archived)->findAll(),
        ];

        $this->display_view('\Plafor\module\list', $data);
    }

    /**
     * Displays a single module
     *
     * @param  integer $module_id ID of the module to show
     * @return void
     */
    public function view_module($module_id = null)
    {
        if (!isset($_SESSION['user_access']) || $_SESSION['user_access'] < config('\User\Config\UserConfig')->access_lvl_admin) {
            return $this->display_view('\User\errors\403error');
        }

        if (!isset($module_id)) {
            // Back to module list
            return redirect()->to(base_url('plafor/module/list_modules'));
        }

        $module = ModuleModel::getInstance()->withDeleted()->find($module_id);
        if (is_null($module)) {
            // Back to module list
            return redirect()->to(base_url('plafor/module/list_modules'));
        }

        $course_plan_models = CoursePlanModuleModel::getInstance()->where('fk_module', $module_id)->findColumn('fk_course_plan');

        $course_plans = [];
        if (!is_null($course_plan_models)) {
            $course_plans = CoursePlanModel::getInstance()->find($course_plan_models);
        }

        $data = [
            'title' => lang('plafor_lang.title_module_view'),
            'course_plans' => $course_plans,
            'module' => $module,
        ];

        $this->display_view('\Plafor\module\view', $data);
    }

    /**
     * Adds or modifies a module
     *
     * @param  integer $module_id      Module to modify, set to 0 to create a new one. Can be submitted with POST.
     * @param  integer $course_plan_id If given and non-zero, the module will be linked with the course plan.
     * @return void
     */
    public function save_module($module_id = 0, $course_plan_id = 0)
    {
        if (!isset($_SESSION['user_access']) || $_SESSION['user_access'] < config('\User\Config\UserConfig')->access_lvl_admin) {
            return $this->display_view('\User\errors\403error');
        }

        $postData = [];

        if (!empty($id = $this->request->getPost('module_id'))) {
            $module_id = $id;
        }
        if (!empty($id = $this->request->getPost('course_plan_id'))) {
            $course_plan_id = $id;
        }

        if ($module_id > 0 && is_null(ModuleModel::getInstance()->find($module_id))) {
            // Back to module list
            return redirect()->to(base_url('plafor/module/list_modules'));
        }

        if (count($_POST) > 0) {
            $module = [
                'module_number' => str_pad($this->request->getPost('module_number'), config('\Plafor\Config\PlaforConfig')->MODULE_NUMBER_MIN_LENGTH, '0', STR_PAD_LEFT),
                'official_name' => $this->request->getPost('official_name'),
                'is_school' => $this->request->getPost('is_school') == 1,
                'version' => $this->request->getPost('version'),
            ];

            if ($module_id > 0) {
                ModuleModel::getInstance()->update($module_id, $module);
            } else {
                $module_id = ModuleModel::getInstance()->insert($module);
            }

            if (ModuleModel::getInstance()->errors() == null) {
                // Bind to a course plan
                if ($course_plan_id != 0) {
                    $course_plan = CoursePlanModel::getInstance()->find($course_plan_id);

                    if (!is_null($course_plan)) {
                        $link = CoursePlanModuleModel::getInstance()->where('fk_course_plan', $course_plan_id)->where('fk_module', $module_id)->find();
                        if (empty($link)) {
                            CoursePlanModuleModel::getInstance()->insert([
                                'fk_course_plan' => $course_plan_id,
                                'fk_module' => $module_id,
                            ]);
                        }
                    }
                }

                return redirect()->to(base_url('/plafor/module/list_modules'));
            }

            $postData = [
                'module_number' => $this->request->getPost('module_number'),
                'official_name' => $this->request->getPost('official_name'),
                'is_school' => $this->request->getPost('is_school'),
                'version' => $this->request->getPost('version'),
                'id' => $module_id,
            ];
        }

        $update = $module_id != 0;
        $title = $update ? 'update' : 'new';
        $data = [
            'title' => lang('plafor_lang.title_module_' . $title),
            'module' => count($postData) > 0 ? $postData : ModuleModel::getInstance()->withDeleted()->find($module_id),
            'errors' => ModuleModel::getInstance()->errors(),
            'update' => $update,
            'course_plan_id' => $course_plan_id,
        ];

        $this->display_view('\Plafor\module\save', $data);
    }

    /**
     * Deletes, deactivates or reactivates a module
     *
     * @param  integer $module_id ID of the module to affect
     * @param  integer $action
     * - 0 to show the confirmation UI
     * - 1 to deactivate (soft delete) the module
     * - 2 to permanently delete the module
     * - 3 to reactivate the module
     * @return void
     */
    public function delete_module($module_id, $action = 0)
    {
        if (!isset($_SESSION['user_access']) || $_SESSION['user_access'] < config('\User\Config\UserConfig')->access_lvl_admin) {
            return $this->display_view('\User\errors\403error');
        }

        $module = ModuleModel::getInstance()->withDeleted()->find($module_id);

        if (is_null($module)) {
            // Back to the list
            return redirect()->to(base_url('/plafor/module/list_modules'));
        }

        switch ($action) {
            case 0: // Display confirmation
                $data = [
                    'module' => $module,
                    'title' => lang('plafor_lang.title_delete_module'),
                ];
                $this->display_view('\Plafor\module\delete', $data);
                break;
            case 1: // Deactivate module
                // Delete course plan links
                CoursePlanModuleModel::getInstance()->where('fk_module', $module_id)->delete();

                ModuleModel::getInstance()->delete($module_id, FALSE);
                return redirect()->to(base_url('/plafor/module/list_modules'));
            case 2: // Delete module
                // Delete course plan links
                CoursePlanModuleModel::getInstance()->where('fk_module', $module_id)->delete();

                ModuleModel::getInstance()->delete($module_id, TRUE);
                return redirect()->to(base_url('/plafor/module/list_modules'));
            case 3: // Reactivate module
                ModuleModel::getInstance()->withDeleted()->update($module_id, ['archive' => NULL]);

                return redirect()->to(base_url('/plafor/module/list_modules'));
            default: // Do nothing
                return redirect()->to(base_url('/plafor/module/list_modules'));
        }
    }
}
