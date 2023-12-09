<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToIndicateurperformanceactionsTable extends Migration
{

    public function up()
    {
        $addfields = [
            'idActivite' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ]
        ];
        $this->forge->addColumn('indicateurperformanceactions', $addfields);

    }

    public function down()
    {
        $this->forge->dropColumn('indicateurperformanceactions', ['idActivite']);
    }
}
