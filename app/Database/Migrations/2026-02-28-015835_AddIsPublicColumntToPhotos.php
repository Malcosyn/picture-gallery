<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsPublicColumntToPhotos extends Migration
{
    public function up()
    {
        $addColumn = [
            'is_public' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1, 
            ],
        ];
        
        $this->forge->addColumn('photos', $addColumn);
    }

    public function down()
    {
        $this->forge->dropColumn('photos', 'is_public');
    }
}
