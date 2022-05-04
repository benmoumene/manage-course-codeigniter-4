<?php

namespace App\Database\Migrations;

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
                'constraint' => '3',
            ],
            'official_name' => [
                'type' => 'varchar',
                'constraint' => '100',
            ],
            'is_school' => [
                'type' => 'int',
                'constraint' => '1',
            ],
            'archive timestamp null',
        ]);

        $this->forge->addKey('id', true, true);
        $this->forge->createTable('module');
    }

    public function down()
    {
        $this->forge->dropTable('module');
    }
}
