<?php

namespace Plafor\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserCourseModule extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => '11',
                'auto_increment' => TRUE,
            ],
            'fk_user_course' => [
                'type' => 'int',
                'unsigned' => true,
                'constraint' => '11',
            ],
            'fk_module' => [
                'type' => 'int',
                'constraint' => '11',
            ],
            'is_school' => [
                'type' => 'int',
                'constraint' => '1',
            ],
        ]);

        $this->forge->addKey('id', TRUE, TRUE);
        $this->forge->addForeignKey('fk_user_course', 'user_course', 'id');
        $this->forge->addForeignKey('fk_module', 'module', 'id');
        $this->forge->createTable('user_course_module', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('user_course_module', TRUE);
    }
}
