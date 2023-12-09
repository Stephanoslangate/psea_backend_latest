<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToUserTable extends Migration
{
    public function up(){
        ## Add age column
        $addfields = [
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ];
        $this->forge->addColumn('user', $addfields);
    }

    public function down()
    {
        ## Delete 'type' column
        $this->forge->dropColumn('user', ['type']);
    }
}
