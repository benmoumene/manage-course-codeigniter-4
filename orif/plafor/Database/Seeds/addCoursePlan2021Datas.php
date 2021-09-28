<?php
namespace Plafor\Database\Seeds;

use CodeIgniter\Database\Seeder;

class addCoursePlan2021Datas extends Seeder{
    public function run(){
        $course_plans = array(
            array('id' => '5','formation_number' => '88611','official_name' => ' Informaticienne / Informaticien Sys','date_begin' => '2020-11-19','archive' => NULL),
            array('id' => '6','formation_number' => '88611','official_name' => ' Informaticienne / Informaticien Dev','date_begin' => '2020-11-19','archive' => NULL),
            array('id' => '7','formation_number' => '88614','official_name' => ' Informaticienne d\'entreprise, Informaticien d\'entreprise','date_begin' => '0000-00-00','archive' => NULL)
        );
        foreach ($course_plans as $course_plan){
            $this->db->table('course_plan')->insert($course_plan);
        }
    }
}

?>