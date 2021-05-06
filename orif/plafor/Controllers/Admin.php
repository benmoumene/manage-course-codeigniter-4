<?php


namespace Plafor\Controllers;


use Plafor\Models\CoursePlanModel;
use Plafor\Models\UserCourseModel;

class Admin extends \App\Controllers\BaseController
{
    private $validation;
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->validation =  \Config\Services::validation();
    }

    /**
     * Displays the list of course plans
     *
     * @return void
     */
    public function list_course_plan($id_apprentice = null)
    {
        $coursePlanModel=new CoursePlanModel();
        $userCourseModel=new UserCourseModel();
        if($id_apprentice == null){
            $course_plans = $coursePlanModel->findAll();
        }else{
            $userCourses = $userCourseModel->getWhere(['fk_user'=>$id_apprentice])->getResult();

            $coursesId = array();

            foreach ($userCourses as $userCourse){
                $coursesId[] = $userCourse->fk_course_plan;
            }

            //$course_plans = $this->course_plan_model->get_many($coursesId);
            $course_plans=$coursePlanModel->whereIn('id',count($coursesId)==0?[null]:$coursesId)->findAll();
        }

        $output = array(
            'course_plans' => $course_plans
        );

        if(is_numeric($id_apprentice)){
            $output[] = ['course_plans' => $course_plans];
        }

        $this->display_view('Plafor\course_plan\list', $output);
    }
    /**
     * Adds or modify a course plan
     *
     * @param integer $course_plan_id = The id of the course plan to modify, leave blank to create a new one
     * @return void
     */
    public function save_course_plan($course_plan_id = 0)
    {
        $coursePlanModel=new CoursePlanModel();

        if (count($_POST) > 0) {
            $course_plan_id = $this->request->getPost('id');
            $rules = array(
                'formation_number'=>[
                    'label' => 'user_lang.field_course_plan_formation_number',
                    'rules' => 'required|max_length['.config('\Plafor\Config\PlaforConfig')->FORMATION_NUMBER_MAX_LENGTH.']|numeric|checkFormPlanNumber',
                ],
                'official_name'=>[
                    'label' => 'user_lang.field_course_plan_official_name',
                    'rules' => 'required|max_length['.config('\Plafor\Config\PlaforConfig')->OFFICIAL_NAME_MAX_LENGTH.']',
                ],'date_begin'=>[
                    'label' => 'user_lang.field_course_plan_official_name',
                    'rules' => 'required|required',
                ]
            );
            $this->validation->setRules($rules);
            if ($this->validation->withRequest($this->request)->run()) {
                $course_plan = array(
                    'formation_number' => $this->request->getPost('formation_number'),
                    'official_name' => $this->request->getPost('official_name'),
                    'date_begin' => $this->request->getPost('date_begin')
                );
                if ($course_plan_id > 0) {
                    $coursePlanModel->update($course_plan_id, $course_plan);
                } else {
                    $coursePlanModel->insert($course_plan);
                }
                return redirect()->to(base_url('/plafor/admin/list_course_plan'));
            }
        }

        $output = array(
            'title' => lang('user_lang.title_course_plan_'.((bool)$course_plan_id ? 'update' : 'new')),
            'course_plan' => $coursePlanModel->find($course_plan_id)
        );

        $this->display_view('\Plafor\course_plan\save', $output);
    }


}