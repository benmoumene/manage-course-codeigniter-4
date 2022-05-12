<?php

namespace Plafor\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddModule extends Migration
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
            'module_number' => [
                'type' => 'varchar',
                'constraint' => '4',
            ],
            'official_name' => [
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'version' => [
                'type' => 'int',
                'constraint' => '11',
            ],
            'archive timestamp null',
        ]);

        $this->forge->addKey('id', true, true);
        $this->forge->createTable('module', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('module', TRUE);
    }
}
