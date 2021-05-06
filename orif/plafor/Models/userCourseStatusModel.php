<?php


namespace Plafor\Models;


class UserCourseStatusModel extends \CodeIgniter\Model
{
    protected $table='user_course_status';
    protected $primaryKey='id';
    protected $allowedFields=['name'];
}