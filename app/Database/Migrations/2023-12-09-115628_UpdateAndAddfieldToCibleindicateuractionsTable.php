<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToCibleindicateuractionsTable extends Migration
{
    public function up()
    {
        $addfields = [
            'justification' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'realisation' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ]
        ];
        $this->forge->addColumn('cibleindicateuractions', $addfields);

    }

    public function down()
    {
        $this->forge->dropColumn('cibleindicateuractions', ['justification','realisation']);
    }
}
