<?php


namespace Plafor\Models;


use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class OperationalCompetenceModel extends \CodeIgniter\Model
{
    private static $operationalCompetenceModel=null;
    protected $table='operational_competence';
    protected $primaryKey='id';
    protected $allowedFields=['fk_competence_domain','name','symbol','methodologic','social','personal'];
    protected $useSoftDeletes='true';
    protected $deletedField='archive';
    private CompetenceDomainModel $competenceDomainModel;

    /**
     * @return OperationalCompetenceModel
     */
    public static function getInstance(){
        if (OperationalCompetenceModel::$operationalCompetenceModel==null)
            OperationalCompetenceModel::$operationalCompetenceModel=new OperationalCompetenceModel();
        return OperationalCompetenceModel::$operationalCompetenceModel;
    }

    /**
     * @param $fkCompetenceDomain
     * @return array|object|null
     */
    public static function getCompetenceDomain($fkCompetenceDomain){
        return CompetenceDomainModel::getInstance()->find($fkCompetenceDomain);
    }

    /**
     * @param $operationalCompetenceId
     * @return array
     */
    public static function getObjectives($operationalCompetenceId){
        return ObjectiveModel::getInstance()->where('fk_operational_competence',$operationalCompetenceId)->findAll();
    }

}