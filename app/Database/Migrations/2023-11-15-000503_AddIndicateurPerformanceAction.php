<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIndicateurPerformanceAction extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idIndicateurAction' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'libelle' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
            ],
            'valeur_de_ref' => [
                'type' => 'INT',
            ],
            'id_action' => [
                'type' => 'INT',
            ],
           
            'type_valeur' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);


        $this->forge->addKey('idIndicateurAction', true);
        $this->forge->createTable('indicateurperformanceactions');
    }

    public function down()
    {
        //
    }
}
