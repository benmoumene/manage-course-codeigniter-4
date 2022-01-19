<?php
namespace Plafor\Database\Seeds;

use CodeIgniter\Database\Seeder;

class addCoursePlan2021Datas extends Seeder{
    public function run(){
        $course_plans = array(
            array('id' => '5','formation_number' => '88611','official_name' => ' Informaticienne / Informaticien Orientation Exploitation et infrastructure CFC','date_begin' => '2022-08-01','archive' => NULL),
            array('id' => '6','formation_number' => '88611','official_name' => ' Informaticienne / Informaticien Orientation Développement d’applications CFC','date_begin' => '2022-08-01','archive' => NULL),
            array('id' => '7','formation_number' => '88614','official_name' => ' Informaticienne d\'entreprise, Informaticien d\'entreprise CFC','date_begin' => '2022-08-01','archive' => NULL)
        );
        foreach ($course_plans as $course_plan){
            $this->db->table('course_plan')->insert($course_plan);
        }
    }
}

?>