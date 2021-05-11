<?php


namespace Plafor\Models;


use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class ObjectiveModel extends \CodeIgniter\Model
{
    private static $objectiveModel=null;
    protected $table='objective';
    protected $primaryKey='id';
    protected $allowedFields=['fk_operational_competence','symbol','taxonomy','name'];
    protected $useSoftDeletes=true;
    protected $deletedField='archive';
    private OperationalCompetenceModel $operationalCompetenceModel;

    /**
     * @return ObjectiveModel
     */
    public static function getInstance(){
        if (ObjectiveModel::$objectiveModel==null)
            ObjectiveModel::$objectiveModel=new ObjectiveModel();
        return ObjectiveModel::$objectiveModel;
    }

    /**
     * @param $fkOperationalCompetence
     * @return array|object|null
     */
    public static function getOperationalCompetence($fkOperationalCompetence){
        return OperationalCompetenceModel::getInstance()->find($fkOperationalCompetence);
    }

    /**
     * @param $objectiveId
     * @return array
     */
    public static function getAcquisitionStatus($objectiveId){
        return AcquisitionStatusModel::getInstance()->where('fk_objective',$objectiveId)->findAll();
    }


}