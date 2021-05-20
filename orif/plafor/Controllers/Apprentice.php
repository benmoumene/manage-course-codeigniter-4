<?php


namespace Plafor\Controllers;


use Plafor\Models\CompetenceDomainModel;
use Plafor\Models\CoursePlanModel;
use Plafor\Models\ObjectiveModel;
use Plafor\Models\OperationalCompetenceModel;
use Plafor\Models\UserCourseModel;
use Plafor\Models\UserCourseStatusModel;
use Plafor\Models\TrainerApprenticeModel;

use User\Models\User_type_model;
use User\Models\User_model;

class Apprentice extends \App\Controllers\BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        $this->access_level=config('\User\Config\UserConfig')->access_level_apprentice;
        parent::initController($request, $response, $logger);
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
        
        //if($trainer_id == null){
            $apprentice_level = User_type_model::getInstance()->where('access_level', config("\User\Config\UserConfig")->access_level_apprentice)->find();
            $apprentices = User_model::getInstance()->where('fk_user_type', $apprentice_level['0']['id'])->findall();
            $coursesList = CoursePlanModel::getInstance()->findall();
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
        
        $user_courses = UserCourseModel::getInstance()->where('fk_user',$apprentice_id)->findall();
        $user_course_status = UserCourseStatusModel::getInstance()->findAll();
        $course_plans = CoursePlanModel::getInstance()->findall();
        
        $trainers = User_model::getInstance()->where('fk_user_type',User_type_model::getInstance()->where('name',lang('user_lang.title_trainer'))->first()['id'])->findall();
        $links = TrainerApprenticeModel::getInstance()->where('fk_apprentice',$apprentice_id)->findAll();
        
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

        $this->display_view('\Plafor/competence_domain/view',$output);
    }
}