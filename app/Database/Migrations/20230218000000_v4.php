<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class dbv4 extends Migration {

    public function up() {
        $this->forge->addField([                    
            'idSocio' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'indicativo' => [
                'type' => 'VARCHAR',
                'constraint' => 8
            ],
            'tipo' => [
                'type' => 'ENUM("CA","CB","CC","PX","EE","ER")'
            ]
        ]);
        $this->forge->addPrimaryKey(['idSocio','indicativo']);
        $this->forge->createTable('socios-licencas');
    }

    public function down() {
        $this->forge->dropTable('socios-licencas');
    }


}