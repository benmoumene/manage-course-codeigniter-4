<?php


namespace Plafor\Models;


use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class OperationalCompetenceModel extends \CodeIgniter\Model
{
    protected $table='operational_competence';
    protected $primaryKey='id';
    protected $allowedFields=['fk_competence_domain','name','symbol','methodologic','social','personal'];
    protected $useSoftDeletes='true';
    protected $deletedField='archive';
    private CompetenceDomainModel $competenceDomainModel;
    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
    }
    public function getCompetenceDomain($operationalCompetence){
        if ($this->competenceDomainModel==null)
        $this->competenceDomainModel=new CompetenceDomainModel();
        return $this->competenceDomainModel->find($operationalCompetence['fk_competence_domain']);
    }

}