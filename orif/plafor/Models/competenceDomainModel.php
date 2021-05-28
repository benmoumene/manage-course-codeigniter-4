<?php 

namespace Plafor\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class CompetenceDomainModel extends Model{
    private static $competenceDomainModel=null;
    protected $table='competence_domain';
    protected $primaryKey='id';
    protected $allowedFields=['fk_course_plan','symbol','name','archive'];
    protected $useSoftDeletes=true;
    protected $deletedField='archive';
    private $coursePlanModel=null;
    private $operationalCompetenceModel=null;

    /**
     * @return CompetenceDomainModel
     */
    public static function getInstance(){
        if (CompetenceDomainModel::$competenceDomainModel==null)
            CompetenceDomainModel::$competenceDomainModel=new CompetenceDomainModel();
        return CompetenceDomainModel::$competenceDomainModel;
    }

    /**
     * @param $fkCoursePlanId
     * @return array|null
     */
    public static function getCoursePlan($fkCoursePlanId){

        return CoursePlanModel::getInstance()->find($fkCoursePlanId);

    }

    /**
     * @param $competenceDomainId
     * @return array|null
     */
    public static function getOperationalCompetences($competenceDomainId){
        return OperationalCompetenceModel::getInstance()->where('fk_competence_domain',$competenceDomainId)->findAll();
    }
}






?>