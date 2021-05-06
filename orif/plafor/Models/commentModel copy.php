<?php 

namespace Plafor\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use User\Models\User_model;

class CommentModel extends Model{

    protected $table='comment';
    protected $primaryKey='id';
    protected $allowedFields=['fk_trainer','fk_acquisition_status','comment','date_creation'];
    private User_model $userModel;
    private AcquisitionStatusModel $acquisitionStatusModel;
    /**To do
     * Add method to get trainer and acquisition_status
     */
    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);


    }

    public function getTrainer($comment){
        if ($this->userModel==null)
        $this->userModel=new User_model();
        return $this->userModel->find($comment['fk_trainer']);
    }
    public function getAcquisitionStatus($comment){
        $this->acquisitionStatusModel=new AcquisitionStatusModel();
        return $this->acquisitionStatusModel->find($comment['fk_acquisition_status']);
    }
}






?>