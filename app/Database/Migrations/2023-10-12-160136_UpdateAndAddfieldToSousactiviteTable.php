<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToSousactiviteTable extends Migration
{
    public function up(){
        ## Add column
        $addfields = [
            'idIndictateur' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
        ];
        $this->forge->addColumn('sousactivite', $addfields);
    }

    public function down()
    {
        ## Delete 'type' column
        $this->forge->dropColumn('sousactivite', ['idIndictateur']);
    }
}
