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

    /**
     * @return UserCourseModel
     */
    public static function getInstance(){
        if (UserCourseModel::$userCourseModel==null)
            UserCourseModel::$userCourseModel=new UserCourseModel();
        return UserCourseModel::$userCourseModel;
    }

    /**
     * @param $fkUserId
     * @return array
     */
    public static function getUser($fkUserId){
        return User_model::getInstance()->find($fkUserId);
    }

    /**
     * @param $fkCoursePlanId
     * @return array
     */
    public static function getCoursePlan($fkCoursePlanId){
        return CoursePlanModel::getInstance()->find($fkCoursePlanId);
    }

    /**
     * @param $fkUserCourseStatusId
     * @return array
     */
    public static function getUserCourseStatus($fkUserCourseStatusId){
        return UserCourseStatusModel::getInstance()->find($fkUserCourseStatusId);
    }

    /**
     * @param $userCourseId
     * @return array
     */
    public static function getAcquisitionStatus($userCourseId){
        return AcquisitionStatusModel::getInstance()->where('fk_user_course',$userCourseId)->findAll();
    }



}