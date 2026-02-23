<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createreport extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'photo_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'reason' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'DATETIME', 'null' => true], 
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('photo_id', 'photos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reports');
    }

    public function down()
    {
        $this->forge->dropTable('reports');
    }
}
