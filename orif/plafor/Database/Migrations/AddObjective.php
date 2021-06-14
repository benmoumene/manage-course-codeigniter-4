<?php
namespace Plafor\Database\Migrations;
use CodeIgniter\Database\Migration;

class AddObjective extends CodeIgniter\Database\Migration {

    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'contraint' => '11',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fk_operational_competence' => [
                'type' => 'int',
            ],
            'symbol' => [
                'type' => 'varchar',
                'constraint' => '10',
            ],
            'taxonomy' => [
                'type' => 'int', 
                'constraint' => '5',
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => '350',
            ],
            'archive timestamp default null',
        ]);

        $this->forge->addKey('id', true, true);
        $this->forge->addKey('fk_operational_competence', false);
        $this->forge->createTable('objective');
    }

    public function down() {
        $this->forge->dropTable('objective');
    }
}