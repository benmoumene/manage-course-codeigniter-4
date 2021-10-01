<?php


namespace Plafor\Database\Seeds;


use CodeIgniter\Database\Seeder;

class addCoursePlanDatas extends Seeder
{
    public function run()
    {
        //course_plan//
        $course_plan = array(
            array('id' => '1','formation_number' => '88601','official_name' => ' Informaticien/-ne CFC Développement d\'applications','date_begin' => '2014-08-01','archive' => NULL),
            array('id' => '2','formation_number' => '88602','official_name' => ' Informaticien/-ne CFC Informatique d\'entreprise','date_begin' => '2014-08-01','archive' => NULL),
            array('id' => '3','formation_number' => '88603','official_name' => ' Informaticien/-ne CFC Technique des systèmes','date_begin' => '2014-08-01','archive' => NULL),
            array('id' => '4','formation_number' => '88605','official_name' => ' Opératrice en informatique / Opérateur en informatique CFC','date_begin' => '2018-08-01','archive' => NULL)
        );

        foreach ($course_plan as $course_plan){
            $this->db->table('course_plan')->insert($course_plan);
        }
    }
}