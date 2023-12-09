<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToActiviteTable extends Migration
{
    public function up(){
        ## Add column
        $addfields = [
            'budgetPtf' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'budgetEtat' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
        ];
        $this->forge->addColumn('activite', $addfields);
    }

    public function down()
    {
        ## Delete 'type' column
        $this->forge->dropColumn('activite', ['budgetPtf','budgetEtat']);
    }
}
