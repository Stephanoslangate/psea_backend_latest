<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCibleIndicateurAction extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idCibleIndicateurActions' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'annee' => [
                'type' => 'INT',
            ],
            'valeur' => [
                'type' => 'INT',
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


        $this->forge->addKey('idCibleIndicateurActions', true);
        $this->forge->createTable('cibleindicateuractions');

    }

    public function down()
    {
        //
    }
}
