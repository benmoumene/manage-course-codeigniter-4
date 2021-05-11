<?php


namespace Plafor\Models;


use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;
use User\Models\User_model;

class TrainerApprenticeModel extends \CodeIgniter\Model
{
    private static $trainerApprenticeModel=null;
    protected $table='trainer_apprentice';
    protected $primaryKey='id';
    protected $allowedFields=['fk_trainer','fk_apprentice'];

    /**
     * @return TrainerApprenticeModel
     */
    public static function getInstance(){
        if (TrainerApprenticeModel::$trainerApprenticeModel==null)
            TrainerApprenticeModel::$trainerApprenticeModel=new TrainerApprenticeModel();
        return TrainerApprenticeModel::$trainerApprenticeModel;
    }

    /**
     * @param $trainerApprentice
     * @return array
     */
    public static function getTrainer($trainerApprentice){
        return User_model::getInstance()->find($trainerApprentice['fk_trainer']);
    }

    /**
     * @param $trainerApprentice
     * @return array
     */
    public static function getApprentice($trainerApprentice){
        return User_model::getInstance()->find($trainerApprentice['fk_apprentice']);

    }
}