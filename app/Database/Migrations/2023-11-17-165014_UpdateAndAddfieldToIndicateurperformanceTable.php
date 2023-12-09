<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToIndicateurperformanceTable extends Migration
{
    public function up()
    {
        $addfields = [
            'realisation' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
        ];
        $this->forge->addColumn('indicateurperformanceactions', $addfields);

    }

    public function down()
    {
        $this->forge->dropColumn('indicateurperformanceactions', ['realisation']);
    }
}
