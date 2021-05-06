<?php 

namespace Plafor\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class AcquisitionStatusModel extends Model{

    protected $table='acquisition_status';
    protected $primaryKey='id';
    protected $allowedFields=['fk_objective','fk_user_course','fk_acquisition_level'];
    private ObjectiveModel $objectiveModel;
    private UserCourseModel $userCourseModel;
    private AcquisitionLevelModel $acquisitionLevelModel;

    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
    }

    /**
     * @param $acquisitionStatut /the array obtained from this model
     * @return array
     */
    public function getObjective($acquisitionStatut){
        $this->objectiveModel = new ObjectiveModel();
        return $this->objectiveModel->find($acquisitionStatut['fk_objective']);

    }
    /**
     * @param $acquisitionStatut /the array obtained from this model
     * @return array
     */
    public function getUserCourse($acquisitionStatut){
        $this->userCourseModel=new UserCourseModel();
        return $this->userCourseModel->find($acquisitionStatut['fk_user_course']);

    }
    /**
     * @param $acquisitionStatut /the array obtained from this model
     * @return array
     */
    public function getAcquisitionLevel($acquisitionStatut){
        if ($this->acquisitionLevelModel==null)
        $this->acquisitionLevelModel=new AcquisitionLevelModel();
        return $this->acquisitionLevelModel->find($acquisitionStatut['fk_acquisition_level']);

    }
}






?>