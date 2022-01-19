<?php


namespace Plafor\Database\Seeds;


use CodeIgniter\Database\Seeder;

class addUserDatas extends Seeder
{
    public function run(){
        //user//
        $users=[
            array (
                'id' => '1',
                'fk_user_type' => '1',
                'username' => 'admin',
                'password' => '$2y$10$tUB5R1MGgbO.zD//WArnceTY8IgnFkVVsudIdHBxIrEXJ2z3WBvcK',
                'archive' => NULL,
                'date_creation' => '2020-07-09 08:11:05',
            ),
            array (
                'id' => '2',
                'fk_user_type' => '1',
                'username' => 'MH',
                'password' => '$2y$10$UnH8eVjd5M51hwpSpP/uR.EteO7DtqzT447e.MqdR3EngnY8pXCcO',
                'archive' => NULL,
                'date_creation' => '2022-01-19 09:02:59',
            ),
        ];
        foreach ($users as $user){
            $this->db->table('user')->insert($user);
        }
    }

}