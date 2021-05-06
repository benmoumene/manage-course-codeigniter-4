<?php 

namespace Plafor\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class CompetenceDomainModel extends Model{

    protected $table='competence_domain';
    protected $primaryKey='id';
    protected $allowedFields=['fk_course_plan','symbol','name','archive'];
    protected $useSoftDeletes=true;
    protected $deletedField='archive';
    private CoursePlanModel $coursePlanModel;
    /**To do
     * Add method to get course_plan
     */

    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);

    }

    public function getCoursePlan($competenceDomain){
        if ($this->coursePlanModel==null)
        $this->coursePlanModel=new CoursePlanModel();

        return $this->coursePlanModel->find($competenceDomain['fk_course_plan']);

    }
}






?>