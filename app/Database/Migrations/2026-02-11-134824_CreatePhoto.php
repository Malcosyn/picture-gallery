<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePhoto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'album_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'category_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'image_path' => ['type' => 'VARCHAR', 'constraint' => 255], // Path to the file
            'title'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'alt_text'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true], // For SEO/Accessibility
            'file_size'  => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('album_id', 'albums', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('photos');
    }

    public function down()
    {
        $this->forge->dropTable('photos');
    }
}
