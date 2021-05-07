<?php


namespace Plafor\Models;


use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;
use User\Models\User_model;

class UserCourseModel extends \CodeIgniter\Model
{
    private static $userCourseModel=null;
    protected $table='user_course';
    protected $primaryKey='id';
    protected $allowedFields=['fk_user','fk_course_plan','fk_status','date_begin','date_end'];
    private User_model $userModel;
    private CoursePlanModel $coursePlanModel;
    private AcquisitionStatusModel $acquisitionStatusModel;

    /**
     * @return UserCourseModel
     */
    public static function getInstance(){
        if (UserCourseModel::$userCourseModel==null)
            UserCourseModel::$userCourseModel=new UserCourseModel();
        return UserCourseModel::$userCourseModel;
    }
    public function getUser($userCourse){
        if ($this->userModel==null)
        $this->userModel=new User_model();
        return $this->userModel->find($userCourse['fk_user']);
    }
    public function getCoursePlan($userCourse){
        if ($this->coursePlanModel==null)
        $this->coursePlanModel=new CoursePlanModel();
        return $this->coursePlanModel->find($userCourse['fk_course_plan']);
    }
    public function getStatut($userCourse){
        if ($this->acquisitionStatusModel==null)
        $this->acquisitionStatusModel=new AcquisitionStatusModel();
        return $this->acquisitionStatusModel->find($userCourse['fk_status']);
    }


}