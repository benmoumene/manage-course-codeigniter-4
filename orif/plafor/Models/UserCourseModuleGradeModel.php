<?php

namespace Plafor\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class UserCourseModuleGradeModel extends Model
{
    /** @var ?UserCourseModuleGradeModel */
    private static $userCourseModuleGradeModel = NULL;
    protected $table = 'user_course_module_grade';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fk_user_course', 'fk_module', 'grade', 'date_exam', 'archive'];
    protected $useSoftDeletes = true;
    protected $deletedField = 'archive';
    protected $validationRules;

    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        $this->validationRules = [
            'fk_user_course' => [
                'label' => 'plafor_lang.course_plan',
                'rules' => 'required|numeric',
            ],
            'fk_module' => [
                'label' => 'plafor_lang.module',
                'rules' => 'required|numeric',
            ],
            'grade' => [
                'label' => 'plafor_lang.grade',
                'rules' => 'required|decimal|greater_than_equal_to[' . config('\Plafor\Config\PlaforConfig')->GRADE_LOWEST . ']|less_than_equal_to[' . config('\Plafor\Config\PlaforConfig')->GRADE_HIGHEST . ']',
            ],
            'date_exam' => [
                'label' => 'plafor_lang.field_grade_date_exam',
                'rules' => 'required',
            ],
        ];

        parent::__construct($db, $validation);
    }

    /**
     * @return UserCourseModuleGradeModel
     */
    public static function getInstance()
    {
        if (UserCourseModuleGradeModel::$userCourseModuleGradeModel == null)
            UserCourseModuleGradeModel::$userCourseModuleGradeModel = new UserCourseModuleGradeModel();
        return UserCourseModuleGradeModel::$userCourseModuleGradeModel;
    }
}
