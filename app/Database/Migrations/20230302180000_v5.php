<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class dbv5 extends Migration {

    public function up() {
        $this->forge->addField([                    
            'idSocio' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'hash' => [
                'type' => 'TEXT',
            ],
        ]);
        $this->forge->createTable('recuperacao-senha');
    }

    public function down() {
        $this->forge->dropTable('recuperacao-senha');
    }


}