<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToIndicateurperformanceTable extends Migration
{
    public function up()
    {
        $addfields = [
            'prevut1' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'prevut2' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'prevut3' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'prevut4' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'realisationt1' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'realisationt2' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'realisationt3' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'realisationt4' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'reference' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
        ];
        $this->forge->addColumn('indicateurperformance', $addfields);

    }

    public function down()
    {
        $this->forge->dropColumn('indicateurperformance', ['reference','realisationt4','realisationt3','realisationt2','realisationt1','prevut4','prevut3','prevut2','prevut1']);
    }
}
