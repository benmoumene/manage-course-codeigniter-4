<?php

namespace Plafor\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class CoursePlanModuleModel extends Model
{
    /** @var ?CoursePlanModuleModel */
    private static $coursePlanModuleModel = null;
    protected $table = 'course_plan_module';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fk_course_plan', 'fk_module', 'is_school'];
    protected $validationRules;

    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        $this->validationRules = [
            'fk_course_plan' => [
                'label' => 'plafor_lang.course_plan',
                'rules' => 'required|numeric',
            ],
            'fk_module' => [
                'label' => 'plafor_lang.module',
                'rules' => 'required|numeric',
            ],
        ];

        parent::__construct($db, $validation);
    }

    /**
     * @return CoursePlanModuleModel
     */
    public static function getInstance()
    {
        if (CoursePlanModuleModel::$coursePlanModuleModel == null)
            CoursePlanModuleModel::$coursePlanModuleModel = new CoursePlanModuleModel();
        return CoursePlanModuleModel::$coursePlanModuleModel;
    }
}
