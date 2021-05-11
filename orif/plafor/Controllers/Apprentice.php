<?php


namespace Plafor\Controllers;


use Plafor\Models\CoursePlanModel;

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
}