<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToActionTable extends Migration
{
    public function up(){
        ## Add column
        $addfields = [
            'version' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ];
        $this->forge->addColumn('action', $addfields);
    }

    public function down()
    {
        ## Delete 'type' column
        $this->forge->dropColumn('action', ['version']);
    }
}
