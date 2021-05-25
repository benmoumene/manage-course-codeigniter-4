<?php


namespace Plafor\Controllers;


use CodeIgniter\Validation\Validation;
use Plafor\Models\CompetenceDomainModel;
use Plafor\Models\CoursePlanModel;
use Plafor\Models\ObjectiveModel;
use Plafor\Models\OperationalCompetenceModel;
use Plafor\Models\UserCourseModel;
use Plafor\Models\UserCourseStatusModel;
use Plafor\Models\TrainerApprenticeModel;

use User\Models\User_type_model;
use User\Models\User_model;

class Admin extends \App\Controllers\BaseController
{
    private Validation $validation;
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

        $this->display_view(['Plafor\templates/admin_menu','Plafor\course_plan\list'], $output);
    }
    /**
     * Adds or modify a course plan
     *
     * @param integer $course_plan_id = The id of the course plan to modify, leave blank to create a new one
     * @return void
     */
    public function save_course_plan($course_plan_id = 0)
    {
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
                    CoursePlanModel::getInstance()->update($course_plan_id, $course_plan);
                } else {
                    CoursePlanModel::getInstance()->insert($course_plan);
                }
                return redirect()->to(base_url('/plafor/admin/list_course_plan'));
            }
        }

        $output = array(
            'title' => lang('user_lang.title_course_plan_'.((bool)$course_plan_id ? 'update' : 'new')),
            'course_plan' => CoursePlanModel::getInstance()->find($course_plan_id)
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

        $this->display_view(['Plafor\templates/admin_Menu','\Plafor\competence_domain\list'], $output);
    }
    /**
     * Displays the list of course plans
     *
     * @return void
     */
    public function list_operational_competence($id_competence_domain = null)
    {
        if($id_competence_domain == null){
            $operational_competences = OperationalCompetenceModel::getInstance()->findAll();
        }else{
            $competence_domain = CompetenceDomainModel::getInstance()->find($id_competence_domain);
            $operational_competences = CompetenceDomainModel::getOperationalCompetences($id_competence_domain);
        }

        $output = array(
            'operational_competences' => $operational_competences
        );

        if(is_numeric($id_competence_domain)){
            $output[] = ['competence_domain' => $competence_domain];
        }

        $this->display_view(['\Plafor\templates\admin_menu','\Plafor/operational_competence/list'], $output);
        exit();
    }
    /**
     * Adds or modify a course plan
     *
     * @param integer $competence_domain_id = The id of the course plan to modify, leave blank to create a new one
     * @return void
     */
    public function save_competence_domain($competence_domain_id = 0)
    {
        if (count($_POST) > 0) {
            $competence_domain_id = $this->request->getPost('id');
            $rules = array(
                    'symbol'=>[
                    'label' => 'user_lang.field_competence_domain_symbol',
                    'rules' => 'required|max_length['.config('\Plafor\Config\PlaforConfig')->SYMBOL_MAX_LENGTH.']'
                    ],
                    'name'=>[
                    'label' => 'user_lang.field_competence_domain_name',
                    'rules' => 'required|max_length['.config('\Plafor\Config\PlaforConfig')->COMPETENCE_DOMAIN_NAME_MAX_LENGTH.']'
                    ],
            );
            $this->validation->setRules($rules);
            if ($this->validation->withRequest($this->request)->run()) {
                $competence_domain = array(
                    'symbol' => $this->request->getPost('symbol'),
                    'name' => $this->request->getPost('name'),
                    'fk_course_plan' => $this->request->getPost('course_plan')
                );
                if ($competence_domain_id > 0) {
                    CompetenceDomainModel::getInstance()->update($competence_domain_id, $competence_domain);
                } else {
                    var_dump($competence_domain);
                    CompetenceDomainModel::getInstance()->insert($competence_domain);
                }
                return redirect()->to(base_url('plafor/admin/list_competence_domain'));
            }
        }
        $course_plans=null;
        foreach (CoursePlanModel::getInstance()->findColumn('official_name') as $courseplanOfficialName)
            $course_plans[CoursePlanModel::getInstance()->where('official_name',$courseplanOfficialName)->first()['id']]=$courseplanOfficialName;
        $output = array(
            'title' => lang('user_lang.title_competence_domain_'.((bool)$competence_domain_id ? 'update' : 'new')),
            'competence_domain' => CompetenceDomainModel::getInstance()->find($competence_domain_id),
            'course_plans' => $course_plans
        );

        $this->display_view('\Plafor\competence_domain/save', $output);
    }
    /**
     * Deletes a course plan depending on $action
     *
     * @param integer $competence_domain_id = ID of the competence_domain to affect
     * @param integer $action = Action to apply on the course plan:
     *  - 0 for displaying the confirmation
     *  - 1 for deactivating (soft delete)
     *  - 2 for deleting (hard delete)
     * @return void
     */
    public function delete_competence_domain($competence_domain_id, $action = 0)
    {
        $competence_domain = CompetenceDomainModel::getInstance()->find($competence_domain_id);
        if (is_null($competence_domain)) {
            return redirect()->to('plafor/admin/competence_domain/list');
        }

        switch($action) {
            case 0: // Display confirmation
                $output = array(
                    'competence_domain' => $competence_domain,
                    'title' => lang('user_lang.title_competence_domain_delete')
                );
                $this->display_view('\Plafor/competence_domain/delete', $output);
                break;
            case 1: // Deactivate (soft delete) competence domain
                $operationalCompetenceIds=[];
                foreach (CompetenceDomainModel::getOperationalCompetences($competence_domain_id) as $operational_competence){
                    $operationalCompetenceIds[] = $operational_competence['id'];
                }

                if (count($operationalCompetenceIds))
                ObjectiveModel::getInstance()->whereIn('fk_operational_competence',$operationalCompetenceIds)->delete();
                OperationalCompetenceModel::getInstance()->where('fk_competence_domain',$competence_domain_id)->delete();
                CompetenceDomainModel::getInstance()->delete($competence_domain_id);
                return redirect()->to(base_url('plafor/admin/list_competence_domain'));
                break;
            default: // Do nothing
                return redirect()->to(base_url('plafor/admin/list_competence_domain'));
        }
    }
    /**
     * Adds or modify a course plan
     *
     * @param integer $operational_competence_id = The id of the course plan to modify, leave blank to create a new one
     * @return void
     */
    public function save_operational_competence($operational_competence_id = 0)
    {
        if (count($_POST) > 0) {
            $operational_competence_id = $this->request->getPost('id');
            $rules = array(
                    'symbol'=>[
                    'label' => 'user_lang.field_operational_competence_symbol',
                    'rules' => 'required|max_length['.config('\Plafor\Config\PlaforConfig')->SYMBOL_MAX_LENGTH.']'
                    ],
                    'name'=>[
                    'label' => 'user_lang.field_operational_name',
                    'rules' => 'required|max_length['.config('\Plafor\Config\PlaforConfig')->OPERATIONAL_COMPETENCE_NAME_MAX_LENGTH.']'
                    ],
                    'methodologic'=>[
                    'label' => 'user_lang.field_operational_methodologic',
                    'rules' => 'max_length['.config('\Plafor\Config\PlaforConfig')->SQL_TEXT_MAX_LENGTH.']'
                    ],
                    'social'=>[
                    'label' => 'user_lang.field_operational_social',
                    'rules' => 'max_length['.config('\Plafor\Config\PlaforConfig')->SQL_TEXT_MAX_LENGTH.']'
                    ],
                    'personal'=>[
                    'label' => 'user_lang.field_operational_personal',
                    'rules' => 'max_length['.config('\Plafor\Config\PlaforConfig')->SQL_TEXT_MAX_LENGTH.']'
                    ],
            );
            $this->validation->setRules($rules);
            if ($this->validation->withRequest($this->request)->run()) {
                $operational_competence = array(
                    'symbol' => $this->request->getPost('symbol'),
                    'name' => $this->request->getPost('name'),
                    'methodologic' => $this->request->getPost('methodologic'),
                    'social' => $this->request->getPost('social'),
                    'personal' => $this->request->getPost('personal'),
                    'fk_competence_domain' => $this->request->getPost('competence_domain')
                );
                if ($operational_competence_id > 0) {
                    OperationalCompetenceModel::getInstance()->update($operational_competence_id, $operational_competence);
                } else {
                    OperationalCompetenceModel::getInstance()->insert($operational_competence);
                }
                return redirect()->to(base_url('plafor/admin/list_operational_competence'));
            }
        }
        $competenceDomains=[];

        foreach (CompetenceDomainModel::getInstance()->findAll() as $competenceDomain)
            $competenceDomains[CompetenceDomainModel::getInstance()->where('id',$competenceDomain['id'])->first()['id']]=$competenceDomain['name'];
        $output = array(
            'title' => lang('user_lang.title_operational_competence_'.((bool)$operational_competence_id ? 'update' : 'new')),
            'operational_competence' => OperationalCompetenceModel::getInstance()->find($operational_competence_id),
            'competence_domains' => $competenceDomains
        );

        $this->display_view('\Plafor\operational_competence/save', $output);
    }
    /**
     * Deletes a course plan depending on $action
     *
     * @param integer $operational_competence_id = ID of the operational_competence to affect
     * @param integer $action = Action to apply on the course plan:
     *  - 0 for displaying the confirmation
     *  - 1 for deactivating (soft delete)
     *  - 2 for deleting (hard delete)
     * @return void
     */
    public function delete_operational_competence($operational_competence_id, $action = 0)
    {
        $operational_competence = OperationalCompetenceModel::getInstance()->find($operational_competence_id);
        if (is_null($operational_competence)) {
            return redirect()->to(base_url('plafor/admin/list_operational_competence'));
        }
        switch($action) {
            case 0: // Display confirmation
                $output = array(
                    'operational_competence' => $operational_competence,
                    'title' => lang('user_lang.title_operational_competence_delete')
                );
                $this->display_view('\Plafor\operational_competence/delete', $output);
                break;
            case 1: // Deactivate (soft delete) operational competence
                ObjectiveModel::getInstance()->where('fk_operational_competence',$operational_competence_id)->delete();
                OperationalCompetenceModel::getInstance()->delete($operational_competence_id, FALSE);
                return redirect()->to(base_url('plafor/admin/list_operational_competence'));
                break;
            default: // Do nothing
                return redirect()->to(base_url('plafor/admin/list_operational_competence'));
                break;
        }
    }
    /**
     * Deletes a trainer_apprentice link depending on $action
     *
     * @param integer $link_id = ID of the trainer_apprentice_link to affect
     * @param integer $action = Action to apply on the trainer_apprentice link :
     *  - 0 for displaying the confirmation
     *  - 1 for deleting (hard delete)
     * @return void
     */
    public function delete_apprentice_link($link_id, $action = 0){
        $link = TrainerApprenticeModel::getInstance()->find($link_id);
        $apprentice = TrainerApprenticeModel::getApprentice($link['fk_apprentice']);
        $trainer = TrainerApprenticeModel::getTrainer($link['fk_trainer']);
        if (is_null($link)) {
            return redirect()->to(base_url('plafor/apprentice/list_apprentice'));
        }

        switch($action) {
            case 0: // Display confirmation
                $output = array(
                    'link' => $link,
                    'apprentice' => $apprentice,
                    'trainer' => $trainer,
                    'title' => lang('user_lang.title_apprentice_link_delete')
                );
                $this->display_view('\Plafor\apprentice/delete', $output);
                break;
            case 1: // Delete apprentice link
                TrainerApprenticeModel::getInstance()->delete($link_id, TRUE);
                return redirect()->to(base_url('plafor/apprentice/list_apprentice/'.$apprentice['id']));
            default: // Do nothing
                return redirect()->to(base_url('plafor/apprentice/list_apprentice/'.$apprentice['id']));
        }
    }
    /**
     * Deletes a user_course depending on $action
     *
     * @param integer $user_course_id = ID of the user_course to affect
     * @param integer $action = Action to apply on the course plan:
     *  - 0 for displaying the confirmation
     *  - 1 for deleting (hard delete)
     * @return void
     */
    public function delete_user_course($user_course_id, $action = 0){
        $user_course = UserCourseModel::getInstance()->find($user_course_id);
        $course_plan = CoursePlanModel::getInstance()->find($user_course['fk_course_plan']);
        $apprentice = User_model::getInstance()->find($user_course['fk_user']);
        $status = UserCourseStatusModel::getInstance()->find($user_course['fk_status']);
        if (is_null($user_course)) {
            //à faire vue
            return redirect()->to(base_url('plafor/admin/user_course/list'));
        }

        switch($action) {
            case 0: // Display confirmation
                $output = array(
                    'user_course' => $user_course,
                    'course_plan' => $course_plan,
                    'apprentice' => $apprentice,
                    'status' => $status,
                    'title' => lang('title_user_course_delete')
                );
                $this->display_view('Plafor\user_course/delete', $output);
                break;
            case 1: // Delete course plan
                /**@todo delete course plan
                 * **/
                UserCourseModel::getInstance()->delete($user_course_id, false);
                return redirect()->to(base_url('plafor/apprentice/list_apprentice'));
            default: // Do nothing
                return redirect()->to(base_url('plafor/apprentice/list_apprentice'));
        }
    }
    /**
     * Displays the list of course plans
     *
     * @return void
     */
    public function list_objective($id_operational_competence = null,bool $with_archived=false)
    {
        $operational_competence=null;
        if($id_operational_competence == null){
            $objectives = ObjectiveModel::getInstance()->findAll();
        }else{
            $operational_competence = OperationalCompetenceModel::getInstance()->find($id_operational_competence);
            $objectives = OperationalCompetenceModel::getObjectives($operational_competence['id']);
        }

        $output = array(
            'objectives' => $objectives,
            'with_archived' => $with_archived
        );

        if(is_numeric($id_operational_competence)){
            $output[] = ['operational_competence',$operational_competence];
        }

        $this->display_view(['Plafor\templates/admin_menu','Plafor\objective/list'], $output);
    }

}