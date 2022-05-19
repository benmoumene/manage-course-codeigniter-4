<?php

namespace Plafor\Models;

use CodeIgniter\Model;

class UserCourseModuleModel extends Model
{
    /** @var ?UserCourseModuleModel */
    private static $userCourseModuleModel = NULL;
    protected $table = 'user_course_module';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fk_user_course', 'fk_module', 'is_school'];

    /**
     * @return UserCourseModuleModel
     */
    public static function getInstance(): self
    {
        if (is_null(self::$userCourseModuleModel)) self::$userCourseModuleModel = new self;
        return self::$userCourseModuleModel;
    }
}
