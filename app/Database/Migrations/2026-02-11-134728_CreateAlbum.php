<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAlbum extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'photographer_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'description' => ['type' => 'TEXT', 'null' => true],
            'is_public'   => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1], // Visibility toggle
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('photographer_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('albums');
    }

    public function down()
    {
        $this->forge->dropTable('albums');
    }
}
