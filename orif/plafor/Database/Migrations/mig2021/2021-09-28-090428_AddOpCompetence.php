<?php
namespace Plafor\Database\Migrations\mig2021;
use CodeIgniter\Database\Migration;

class AddOpCompetence extends Migration {

    public function up() {


        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'contraint' => '11',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fk_competence_domain' => [
                'type' => 'int',
                'null'=>true,
                'unsigned' => true,
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

            'archive timestamp null',
        ]);

        $this->forge->addKey('id', true, true);
        $this->forge->addForeignKey('fk_competence_domain', 'competence_domain','id');
        try {
            $this->db->tableExists('operational_competence')===true?:$this->forge->createTable('operational_competence');
        }catch (\Exception $e){
            echo $e->getMessage();
        }
        $seeder = \Config\Database::seeder();
        if (ENVIRONMENT === 'testing') $seeder->setSilent(TRUE);
        $seeder->call('\Plafor\Database\Seeds\addOperationalCompetences2021Datas');
    }

    public function down() {
        $this->forge->dropTable('operational_competence');
    }
}
