<?php


namespace Plafor\Controllers;


use Plafor\Models\AcquisitionLevelModel;
use Plafor\Models\AcquisitionStatusModel;
use Plafor\Models\CompetenceDomainModel;
use Plafor\Models\CoursePlanModel;
use Plafor\Models\ObjectiveModel;
use Plafor\Models\OperationalCompetenceModel;
use Plafor\Models\TrainerApprenticeModel;
use Plafor\Models\UserCourseModel;
use User\Models\User_model;

class CoursePlan extends \App\Controllers\BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        $this->access_level=config('\User\Config\UserConfig')->access_lvl_admin;
        parent::initController($request, $response, $logger);
    }

    /**
     * Displays the list of course plans
     *
     * @return void
     */
    public function list_course_plan($id_apprentice = null, bool $with_archived=false)
    {
        $id_apprentice==0?$id_apprentice = null:null;
        $coursePlanModel=new CoursePlanModel();
        $userCourseModel=new UserCourseModel();
        if($id_apprentice == null){
            $course_plans = $coursePlanModel->withDeleted($with_archived)->findAll();
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
            'title' =>  lang('plafor_lang.title_list_course_plan'),
            'course_plans' => $course_plans,
            'with_archived' => $with_archived
        );

        if(is_numeric($id_apprentice)){
            $output[] = ['course_plans' => $course_plans];
        }

        $this->display_view(['Plafor\course_plan\list'], $output);
    }
    /**
     * Show details of the selected course plan
     *
     * @param int (SQL PRIMARY KEY) $course_plan_id
     *
     */
    public function view_course_plan($course_plan_id = null)
    {

        $course_plan = CoursePlanModel::getInstance()->withDeleted(true)->find($course_plan_id);
        $competence_domains=CoursePlanModel::getCompetenceDomains($course_plan_id);
        if($course_plan == null){
            return redirect()->to(base_url('plafor/courseplan/list_course_plan'));
        }

        $output = array(
            'title'=>lang('plafor_lang.title_course_plan_view'),
            'course_plan' => $course_plan,
            'competence_domains'=>$competence_domains
        );

        $this->display_view('\Plafor\course_plan\view',$output);
    }
    /**
     * Show details of the selected competence domain
     *
     * @param int (SQL PRIMARY KEY) $competence_domain_id
     *
     */
    public function view_competence_domain($competence_domain_id = null)
    {
        $competence_domain = CompetenceDomainModel::getInstance()->withDeleted()->find($competence_domain_id);

        if($competence_domain == null){
            return redirect()->to(base_url('plafor/courseplan/list_course_plan'));
        }

        $output = array(
            'title' =>lang('plafor_lang.title_view_competence_domain'),
            'course_plan' =>CompetenceDomainModel::getCoursePlan($competence_domain['fk_course_plan'],true),
            'competence_domain' => $competence_domain,
        );

        return $this->display_view('\Plafor/competence_domain/view',$output);
    }
    /**
     * Show details of the selected operational competence
     *
     * @param int $operational_competence_id = ID of the operational competence to view
     * @return void
     */
    public function view_operational_competence($operational_competence_id = null)
    {
        $operational_competence = OperationalCompetenceModel::getInstance()->withDeleted(true)->find($operational_competence_id);

        if($operational_competence == null){
            return redirect()->to(base_url('plafor/courseplan/list_course_plan/'));
        }

        $competence_domain=null;
        $course_plan=null;
        try {
            $competence_domain = OperationalCompetenceModel::getCompetenceDomain($operational_competence['fk_competence_domain']);
            $course_plan = CompetenceDomainModel::getCoursePlan($competence_domain['fk_course_plan']);
        }catch (Exception $exception){

        }
        $objectives=OperationalCompetenceModel::getObjectives($operational_competence['id']);
        $output = array(
            'title'=>lang('plafor_lang.title_view_operational_competence'),
            'operational_competence' => $operational_competence,
            'competence_domain' => $competence_domain,
            'course_plan' => $course_plan,
            'objectives' => $objectives
        );

        return $this->display_view('\Plafor/operational_competence/view',$output);
    }
    /**
     * Show details of the selected objective
     * @param int $objective_id = ID of the objective to view
     * @return void
     */
    public function view_objective($objective_id = null)
    {
        $objective = ObjectiveModel::getInstance()->withDeleted()->find($objective_id);

        if($objective == null){
            return redirect()->to(base_url('plafor/courseplan/list_course_plan'));
        }


        $operational_competence = ObjectiveModel::getOperationalCompetence($objective['fk_operational_competence'],true);

        $competence_domain = OperationalCompetenceModel::getCompetenceDomain($operational_competence['fk_competence_domain']);
        $course_plan=null;
        if (isset($competence_domain))
            $course_plan = CompetenceDomainModel::getCoursePlan($competence_domain['fk_course_plan']);

        $output = array(
            'title' => lang('plafor_lang.title_view_objective'),
            'objective' => $objective,
            'operational_competence' => $operational_competence,
            'competence_domain' => $competence_domain,
            'course_plan' => $course_plan
        );

        $this->display_view('Plafor\objective/view',$output);
    }
}