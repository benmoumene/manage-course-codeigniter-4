<?php
namespace Plafor\Database\Migrations;
use CodeIgniter\Database\Migration;

class AddOpCompetence extends CodeIgniter\Database\Migration {

    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'contraint' => '11',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fk_competence_domain' => [
                'type' => 'int',
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => '150',
                'default' => 'null',
            ],
            'symbol' => [
                'type' => 'varchar',
                'constraint' => '10',
            ],
            'methodologic' => [
                'type' => 'text',
                'default' => 'null',
            ],
            'social' => [
                'type' => 'text',
                'default' => 'null',
            ],
            'personal' => [
                'type' => 'text',
                'default' => 'null',
            ],

            'archive timestamp default null',
        ]);

        $this->forge->addKey('id', true, true);
        $this->forge->addKey('fk_competence_domain', false);
        $this->forge->createTable('operational_competence');
    }

    public function down() {
        $this->forge->dropTable('operational_competence');
    }
}