<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AlbumSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'photographer_id' => 5,
                'title'           => 'Pemandangan Alam Bromo',
                'description'     => 'Koleksi foto matahari terbit di penanjakan Gunung Bromo.',
                'is_public'       => 1,
                'created_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'photographer_id' => 1,
                'title'           => 'Wedding Client - Budi & Shanti',
                'description'     => 'Dokumentasi acara pernikahan di Gedung Serbaguna.',
                'is_public'       => 0, 
                'created_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        // Memasukkan data ke tabel albums
        $this->db->table('albums')->insertBatch($data);
    }
}
