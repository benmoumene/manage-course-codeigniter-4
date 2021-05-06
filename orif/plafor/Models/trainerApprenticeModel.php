<?php


namespace Plafor\Models;


use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;
use User\Models\User_model;

class TrainerApprenticeModel extends \CodeIgniter\Model
{
    protected $table='trainer_apprentice';
    protected $primaryKey='id';
    protected $allowedFields=['fk_trainer','fk_apprentice'];
    private User_model $userModel;
    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
    }
    public function getTrainer($trainerApprentice){
        if ($this->userModel==null)
        $this->userModel=new User_model();
        return $this->userModel->find($trainerApprentice['fk_trainer']);
    }
    public Function getApprentice($trainerApprentice){
        if ($this->userModel==null)
        $this->userModel=new User_model();
        return $this->userModel->find($trainerApprentice['fk_apprentice']);

    }
}