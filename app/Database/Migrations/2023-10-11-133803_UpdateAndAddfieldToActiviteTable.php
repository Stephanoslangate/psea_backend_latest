<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToActiviteTable extends Migration
{
    public function up(){
        ## Add age column
        $addfields = [
            'idAction' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
        ];
        $this->forge->addColumn('activite', $addfields);
        $this->forge->dropColumn('activite', ['idProcedure']);

    }

    public function down()
    {
        ## Delete 'type' column
        $this->forge->dropColumn('activite', ['idAction']);
    }
}
