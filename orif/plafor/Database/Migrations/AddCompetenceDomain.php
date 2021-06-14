<?php
namespace Plafor\Database\Migrations;
use CodeIgniter\Database\Migration;

class AddCompetenceDomain extends CodeIgniter\Database\Migration {

    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'contraint' => '11',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fk_course_plan' => [
                'type' => 'int',
            ],
            'symbol' => [
                'type' => 'varchar',
                'constraint' => '10',
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'archive timestamp default null',
        ]);

        $this->forge->addKey('id', true, true);
        $this->forge->addKey('fk_course_plan', false);
        $this->forge->createTable('competence_domain');
    }

    public function down() {
        $this->forge->dropTable('competence_domain');
    }
}