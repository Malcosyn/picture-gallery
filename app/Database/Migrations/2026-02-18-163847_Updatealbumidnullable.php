<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdatePhotosAlbumIdNullable extends Migration
{
    public function up()
    {
        $this->forge->dropForeignKey('photos', 'photos_album_id_foreign');

        $this->forge->modifyColumn('photos', [
            'album_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'default'    => null,
            ],
        ]);

        $this->forge->addForeignKey('album_id', 'albums', 'id', 'SET NULL', 'CASCADE');
        $this->forge->processIndexes('photos');
    }

    public function down()
    {
        $this->forge->dropForeignKey('photos', 'photos_album_id_foreign');

        $this->forge->modifyColumn('photos', [
            'album_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
        ]);

        $this->forge->addForeignKey('album_id', 'albums', 'id', 'CASCADE', 'CASCADE');
        $this->forge->processIndexes('photos');
    }
}