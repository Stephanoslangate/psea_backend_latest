<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToTacheTable extends Migration
{
    public function up(){
        ## Add column
        $addfields = [
            'trimestre' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ];
        $this->forge->addColumn('tache', $addfields);
    }

    public function down()
    {
        ## Delete 'type' column
        $this->forge->dropColumn('tache', ['trimestre']);
    }
}
