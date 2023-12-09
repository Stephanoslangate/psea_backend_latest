<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToDepenseTable extends Migration
{
    public function up()
    {
        $addfields = [
            'lfi' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'actemodif' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'execution' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
        ];
        $this->forge->addColumn('depense', $addfields);

    }

    public function down()
    {
        $this->forge->dropColumn('depense', ['lfi','actemodif','execution']);
    }
}
