<?php


namespace Plafor\Models;


use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class ObjectiveModel extends \CodeIgniter\Model
{
    protected $table='objective';
    protected $primaryKey='id';
    protected $allowedFields=['fk_operational_competence','symbol','taxonomy','name'];
    protected $useSoftDeletes=true;
    protected $deletedField='archive';
    private OperationalCompetenceModel $operationalCompetenceModel;

    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
    }
    public function getOperationalCompetence($objective){
        if ($this->operationalCompetenceModel==null)
        $this->operationalCompetenceModel=new OperationalCompetenceModel();
        return $this->operationalCompetenceModel->find($objective['fk_operational_competence']);
    }


}