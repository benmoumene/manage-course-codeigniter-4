<?php

namespace Plafor\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCoursePlanModule extends Migration
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
            'fk_course_plan' => [
                'type' => 'int',
                'contraint' => '11',
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

        $this->forge->addKey('id', true, true);
        $this->forge->addForeignKey('fk_course_plan', 'course_plan', 'id');
        $this->forge->addForeignKey('fk_module', 'module', 'id');
        $this->forge->createTable('course_plan_module', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('course_plan_module', TRUE);
    }
}
