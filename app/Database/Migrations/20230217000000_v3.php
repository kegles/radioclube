<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class dbv3 extends Migration {

    public function up() {
        $this->forge->addColumn('socios',[
            'ativo' => [
                'type' => 'ENUM("Y","N")',
                'default' => 'Y',
                'null' => false,
            ],
        ]);
        $this->forge->addColumn('socios',[
            'aprovado' => [
                'type' => 'ENUM("Y","N")',
                'default' => 'N',
                'null' => false,
            ],
        ]);
    }

    public function down() {
        $this->forge->dropColumn('socios', 'ativo');
        $this->forge->dropColumn('socios', 'aprovado');
    }


}