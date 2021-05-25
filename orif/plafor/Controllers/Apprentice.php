<?php


namespace Plafor\Controllers;


use CodeIgniter\Config\Services;
use CodeIgniter\Validation\Validation;
use Plafor\Models\AcquisitionStatusModel;
use Plafor\Models\CompetenceDomainModel;
use Plafor\Models\CoursePlanModel;
use Plafor\Models\OperationalCompetenceModel;
use Plafor\Models\UserCourseModel;
use Plafor\Models\UserCourseStatusModel;
use Plafor\Models\TrainerApprenticeModel;

use User\Models\User_type_model;
use User\Models\User_model;

class Apprentice extends \App\Controllers\BaseController
{
    private Validation $validation;
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        $this->access_level=config('\User\Config\UserConfig')->access_level_apprentice;
        parent::initController($request, $response, $logger);
        $this->validation=Services::validation();
    }
    /**
     * Show details of the selected course plan
     *
     * @param int (SQL PRIMARY KEY) $course_plan_id
     *
     */
    public function view_course_plan($course_plan_id = null)
    {

        $course_plan = CoursePlanModel::getInstance()->find($course_plan_id);
        $competence_domains=CoursePlanModel::getCompetenceDomains($course_plan_id);
        if($course_plan == null){
            return redirect()->to(base_url('plafor/apprentice/list_course_plan'));
        }

        $output = array(
            'course_plan' => $course_plan,
            'competence_domains'=>$competence_domains
        );

        $this->display_view('\Plafor\course_plan\view',$output);
    }
    
    public function list_apprentice()
    {
        $intermediateList=[];
        //if($trainer_id == null){
            $apprentice_level = User_type_model::getInstance()->where('access_level', config("\User\Config\UserConfig")->access_level_apprentice)->find();
            $apprentices = User_model::getInstance()->where('fk_user_type', $apprentice_level['0']['id'])->findall();

            $coursesList=[];
            foreach (CoursePlanModel::getInstance()->findall() as $courseplan)
                $coursesList[$courseplan['id']]=$courseplan;
            $courses = UserCourseModel::getInstance()->findall();
        //}else{
        //        $apprentices = $this->user_model->get_many_by(array('id' => $trainer_id));
            
        //}
        
        $output = array(
            'apprentices' => $apprentices,
            'coursesList' => $coursesList,
            'courses' => $courses
        );

        $this->display_view(['Plafor\templates/admin_menu','Plafor\apprentice/list'], $output);
    }

    public function view_apprentice($apprentice_id = null)
    {
        $apprentice = User_model::getInstance()->find($apprentice_id);
        
        if(is_null($apprentice) || $apprentice['fk_user_type'] != User_type_model::getInstance()->where('name',lang('user_lang.title_apprentice'))->first()['id']){
            return redirect()->to(base_url("/plafor/apprentice/list_apprentice"));
        }
        $user_courses=[];
        foreach (UserCourseModel::getInstance()->where('fk_user',$apprentice_id)->findall() as $usercourse)
        $user_courses[$usercourse['id']] = $usercourse ;

        $user_course_status=[];
        foreach (UserCourseStatusModel::getInstance()->findAll() as $usercoursetatus)
        $user_course_status[$usercoursetatus['id']] = $usercoursetatus;

        $course_plans=[];
        foreach (CoursePlanModel::getInstance()->findall() as $courseplan)
        $course_plans[$courseplan['id']] = $courseplan;

        $trainers = [];
        foreach (User_model::getInstance()->where('fk_user_type',User_type_model::getInstance()->where('name',lang('user_lang.title_trainer'))->first()['id'])->findall() as $trainer)
            $trainers[$trainer['id']]= $trainer;

        $links = [];
        foreach (TrainerApprenticeModel::getInstance()->where('fk_apprentice',$apprentice_id)->findAll() as $link)
            $links[$link['id']]=$link;
        
        $output = array(
            'apprentice' => $apprentice,
            'trainers' => $trainers,
            'links' => $links,
            'user_courses' => $user_courses,
            'user_course_status' => $user_course_status,
            'course_plans' => $course_plans
        );/*
        var_dump($course_plan);
        exit();*/
        $this->display_view('Plafor\apprentice/view',$output);
    }
    /**
     * Show details of the selected competence domain
     *
     * @param int (SQL PRIMARY KEY) $competence_domain_id
     *
     */
    public function view_competence_domain($competence_domain_id = null)
    {
        $competence_domain = CompetenceDomainModel::getInstance()->find($competence_domain_id);

        if($competence_domain == null){
            return redirect()->to(base_url('admin/list_competence_domain'));
        }

        $output = array(
            'course_plan' =>CompetenceDomainModel::getCoursePlan($competence_domain['fk_course_plan'])
        ,
            'competence_domain' => $competence_domain,
        );

        return $this->display_view('\Plafor/competence_domain/view',$output);
    }
    /**
     * Form to create a link between a apprentice and a course plan
     *
     * @param int (SQL PRIMARY KEY) $id_user_course
     */
    public function save_user_course($id_apprentice = null,$id_user_course = 0){

        $apprentice = User_model::getInstance()->find($id_apprentice);
        $user_course = UserCourseModel::getInstance()->find($id_user_course);

        if($id_apprentice == null || $apprentice['fk_user_type'] != User_type_model::getInstance()->where('name',lang('user_lang.title_apprentice'))->first()['id']){
            return redirect()->to(base_url('plafor/apprentice/list_apprentice'));
            exit();
        }

        if(count($_POST) > 0){
            $rules = array(
                    'course_plan'=>[
                    'label' => 'user_lang.course_plan',
                    'rules' => 'required|numeric',
                ],
                    'status'=>[
                    'label' => 'user_lang.status',
                    'rules' => 'required|numeric',
                ],
                    'date_begin'=>[
                    'label' => 'user_lang.field_user_course_date_begin',
                    'rules' => 'required',
                ]
                /*
                array(
                    'field' => 'date_end',
                    'label' => 'lang:field_user_course_date_end',
                    'rules' => 'required',
                ),
                */
            );

            $this->validation->setRules($rules);

            if($this->validation->withRequest($this->request)->run()){
                $user_course = array(
                    'fk_user' => $id_apprentice,
                    'fk_course_plan' => $this->request->getPost('course_plan'),
                    'fk_status' => $this->request->getPost('status'),
                    'date_begin' => $this->request->getPost('date_begin'),
                    'date_end' => $this->request->getPost('date_end'),
                );

                if($id_user_course > 0){
                    echo UserCourseModel::getInstance()->update($id_user_course, $user_course);
                }else{
                    $id_user_course = UserCourseModel::getInstance()->insert($user_course);

                    $course_plan = UserCourseModel::getCoursePlan($user_course['fk_course_plan']);
                    $competenceDomainIds=[];
                    foreach (CoursePlanModel::getCompetenceDomains($course_plan['id']) as $competence_domain){
                        $competenceDomainIds[] = $competence_domain['id'];
                    }

                    $operational_competences = OperationalCompetenceModel::getInstance()->whereIn('fk_competence_domain',$competenceDomainIds)->findAll();
                    $objectiveIds = array();
                    foreach ($operational_competences as $operational_competence){
                        foreach (OperationalCompetenceModel::getObjectives($operational_competence['id']) as $objective){
                            $objectiveIds[] = $objective['id'];
                        }
                    }
                    foreach ($objectiveIds as $objectiveId){
                        $acquisition_status = array(
                            'fk_objective' => $objectiveId,
                            'fk_user_course' => $id_user_course,
                            'fk_acquisition_level' => 1
                        );

                        AcquisitionStatusModel::getInstance()->insert($acquisition_status);
                    }
                }
                return redirect()->to(base_url('plafor/apprentice/view_apprentice/'.$id_apprentice));
                exit();
            }
        }
        $course_plans=[];
        foreach (CoursePlanModel::getInstance()->findAll() as $courseplan)
            $course_plans[$courseplan['id']]=$courseplan['official_name'];
        $status=[];
        foreach (UserCourseStatusModel::getInstance()->findAll() as $usercoursestatus) {
            $status[$usercoursestatus['id']]=$usercoursestatus['name'];
        }
        $output = array(
            'title' => lang('user_course_title_course_plan_link'),
            'course_plans' => $course_plans,
            'user_course'   => $user_course,
            'status' => $status,
            'apprentice' => $apprentice
        );

        $this->display_view('Plafor\user_course/save',$output);
    }
}