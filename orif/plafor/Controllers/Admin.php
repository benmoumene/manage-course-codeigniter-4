<?php


namespace Plafor\Controllers;


use Plafor\Models\CompetenceDomainModel;
use Plafor\Models\CoursePlanModel;
use Plafor\Models\ObjectiveModel;
use Plafor\Models\OperationalCompetenceModel;
use Plafor\Models\UserCourseModel;
use User\Models\User_type_model;
use User\Models\User_model;

class Admin extends \App\Controllers\BaseController
{
    private $validation;
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        $this->access_level=config('\User\Config\UserConfig')->access_lvl_admin;
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

        $this->display_view(['Plafor\templates/template_Menu','Plafor\course_plan\list'], $output);
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
    /**
     * Deletes a course plan depending on $action
     *
     * @param integer $course_plan_id = ID of the course_plan to affect
     * @param integer $action = Action to apply on the course plan:
     *  - 0 for displaying the confirmation
     *  - 1 for deactivating (soft delete)
     *  - 2 for deleting (hard delete)
     * @return void
     */
    public function delete_course_plan($course_plan_id, $action = 0)
    {
        $competenceDomainIds=[];
        $objectiveIds=[];

        $course_plan = CoursePlanModel::getInstance()->find($course_plan_id);
        if (is_null($course_plan)) {
            return redirect()->to('/plafor/admin/list_course_plan');
        }
        switch($action) {
            case 0: // Display confirmation
                $output = array(
                    'course_plan' => $course_plan,
                    'title' => lang('title_course_plan_delete')
                );
                $this->display_view('\Plafor\course_plan\delete', $output);
                break;
            case 1: // Deactivate (soft delete) course plan
                //get linked competence domain

                $competenceDomains=CoursePlanModel::getCompetenceDomains($course_plan['id']);
                $operationalCompetences=[];
                $objectives=[];

                foreach ($competenceDomains as $competence_domain){
                    //get all operationnal competences in an array($operational_competences) which format is [[:competencedomainid]=>[operationalCompetence id, name, etc...],[:competencedomainid]=>[operationalCompetence id, name, etc...]
                    $operationalCompetences[$competence_domain['id']]=CompetenceDomainModel::getOperationalCompetences($competence_domain['id']);
                    //get all objectives assiociated with an operational_competence in an array($objectives) which format is [[operationalcompetenceid]=>[objectives id,fkop, symbol, etc...]
                    foreach ($operationalCompetences as list($operationalCompetence)){
                        $objectives[$operationalCompetence['id']]=OperationalCompetenceModel::getObjectives($operationalCompetence['id']);
                    }
                }
                //get all ids
                $competenceDomainIds=array_column($competenceDomains,'id');
                foreach ($objectives as list($objective)) {
                    $objectiveIds[] = $objective['id'];

                }




                count($objectiveIds)>0?ObjectiveModel::getInstance()->whereIn('id',$objectiveIds)->delete():null;
                count($competenceDomainIds)>0?OperationalCompetenceModel::getInstance()->whereIn('fk_competence_domain',$competenceDomainIds)->delete():null;
                CompetenceDomainModel::getInstance()->where('fk_course_plan',$course_plan_id);
                CoursePlanModel::getInstance()->delete($course_plan_id, FALSE);
                return redirect()->to('/plafor/admin/list_course_plan');
                break;
            default:
                // Do nothing
                return redirect()->to('/plafor/admin/list_course_plan');
        }
    }
    /**
     * Displays the list of course plans
     *
     * @return void
     */
    public function list_competence_domain($id_course_plan = null)
    {
        if($id_course_plan == null){
            $competence_domains = CompetenceDomainModel::getInstance()->findAll();
        }else{
            $course_plan = CoursePlanModel::getInstance()->find($id_course_plan);
            $competence_domains = CoursePlanModel::getCompetenceDomains($course_plan['id']);
        }

        $output = array(
            'competence_domains' => $competence_domains
        );

        if(is_numeric($id_course_plan)){
            $output[] = ['course_plan' => $course_plan];
        }

        $this->display_view(['Plafor\templates/template_Menu','\Plafor\competence_domain\list'], $output);
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

        $this->display_view(['Plafor\templates/template_Menu','Plafor\apprentice/list'], $output);
    }

    public function view_apprentice($apprentice_id = null)
    {
        $apprentice = $this->user_model->get($apprentice_id);
        
        if($apprentice->fk_user_type != $this->user_type_model->get_by('name',$this->lang->line('title_apprentice'))->id){
            redirect(base_url('apprentice/list_apprentice'));
            exit();
        }
        
        $user_courses = $this->user_course_model->get_many_by('fk_user',$apprentice_id);
        $user_course_status = $this->user_course_status_model->get_all();
        $course_plans = $this->course_plan_model->get_all();
        
        $trainers = $this->user_model->get_many_by('fk_user_type',$this->user_type_model->get_by('name',$this->lang->line('title_trainer'))->id);
        $links = $this->trainer_apprentice_model->get_many_by('fk_apprentice',$apprentice_id);
        
        $output = array(
            'apprentice' => $apprentice,
            'trainers' => $trainers,
            'links' => $links,
            'user_courses' => $user_courses,
            'user_course_status' => $user_course_status,
            'course_plans' => $course_plans
        );
        
        $this->display_view('apprentice/view',$output);
    }
    
}