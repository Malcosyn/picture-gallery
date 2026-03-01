<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlbumSave extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'album_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'photo_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('album_id', 'albums', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('photo_id', 'photos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('album_saves');
    }

    public function down()
    {
        $this->forge->dropTable('album_saves');
    }
}
