<?php
namespace Plafor\Database\Migrations;
use CodeIgniter\Database\Migration;

class AddAcquisitionLevel extends CodeIgniter\Database\Migration {

    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'contraint' => '11',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => '20',
            ],
        ]);

        $this->forge->addKey('id', true, true);
        $this->forge->createTable('acquisition_level');
    }

    public function down() {
        $this->forge->dropTable('acquisition_level');
    }
}