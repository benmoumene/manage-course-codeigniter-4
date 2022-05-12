<?php

namespace Plafor\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class ModuleModel extends Model
{
    /** @var ?ModuleModel */
    private static $moduleModel = null;
    protected $table = 'module';
    protected $primaryKey = 'id';
    protected $allowedFields = ['module_number', 'official_name', 'version', 'archive'];
    protected $useSoftDeletes = true;
    protected $deletedField = 'archive';
    protected $validationRules;

    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        $this->validationRules = [
            'module_number' => [
                'label' => 'plafor_lang.field_module_module_number',
                'rules' => 'required|max_length[' . config('\Plafor\Config\PlaforConfig')->MODULE_NUMBER_MAX_LENGTH . ']',
            ],
            'official_name' => [
                'label' => 'plafor_lang.field_module_official_name',
                'rules' => 'required|max_length[' . config('\Plafor\Config\PlaforConfig')->MODULE_OFFICIAL_NAME_MAX_LENGTH . ']',
            ],
            'version' => [
                'label' => 'plafor_lang.field_module_version',
                'rules' => 'required|numeric',
            ],
        ];
        parent::__construct($db, $validation);
    }

    /**
     * @return ModuleModel
     */
    public static function getInstance()
    {
        if (ModuleModel::$moduleModel == null)
            ModuleModel::$moduleModel = new ModuleModel();
        return ModuleModel::$moduleModel;
    }

    /**
     * @param  int   $fkModule
     * @return array
     */
    public static function getCoursePlanModules($fkModule)
    {
        return CoursePlanModuleModel::getInstance()->where('fk_module', $fkModule)->findAll();
    }
}
