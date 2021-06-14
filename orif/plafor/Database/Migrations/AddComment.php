<?php
namespace Plafor\Database\Migrations;
use CodeIgniter\Database\Migration;

class AddComment extends CodeIgniter\Database\Migration {

    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'contraint' => '11',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fk_trainer' => [
                'type' => 'int',
            ],
            'fk_acquisition_status' => [
                'type' => 'int',
            ],
            'comment' => [
                'type' => 'text',
            ],
            'date_creation datetime default current_timestamp',
        ]);

        $this->forge->addKey('id', true, true);
        $this->forge->addKey('fk_trainer', false);
        $this->forge->addKey('fk_acquisition_status', false);
        $this->forge->createTable('Comment');
    }

    public function down() {
        $this->forge->dropTable('comment');
    }
}