<?php


namespace Plafor\Database\Seeds;


use CodeIgniter\Database\Seeder;

class addAcquisitionStatusDatas extends Seeder
{
    public function run()
    {
        //Acquisition status//
        $acquisition_status = array(
            //array('id' => '1','fk_objective' => '1','fk_user_course' => '1','fk_acquisition_level' => '1'),
        );
        foreach ($acquisition_status as $acquisitionStatuse){
            $this->db->table('acquisition_status')->insert($acquisitionStatuse);
        }


    }

}