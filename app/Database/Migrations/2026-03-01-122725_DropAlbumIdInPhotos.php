<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropAlbumIdInPhotos extends Migration
{
    public function up()
    {
        $this->forge->dropForeignKey('photos', 'photos_album_id_foreign');
        $this->forge->dropColumn('photos', 'album_id');
    }

    public function down()
    {
        $this->forge->addColumn('photos', [
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
}
