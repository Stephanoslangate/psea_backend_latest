<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IndicateurActivite extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idIndicateurActivite' => [
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
            'idActivite' => [
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


        $this->forge->addKey('idIndicateurActivite', true);
        $this->forge->createTable('indicateuractivites');
    }

    public function down()
    {
        $this->forge->dropTable('indicateuractivites');

    }
}
