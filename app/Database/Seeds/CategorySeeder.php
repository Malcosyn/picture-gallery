<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Nature',
                'slug' => 'nature'
            ],
            [
                'name' => 'Building',
                'slug' => 'building'
            ],
            [
                'name' => 'Portrait',
                'slug' => 'portrait'
            ],
        ];

        // Memasukkan data ke tabel 'categories'
        $this->db->table('categories')->insertBatch($data);
    }
}