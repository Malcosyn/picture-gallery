<?php

namespace App\Models;

use CodeIgniter\Model;

class AlbumSaveModel extends Model
{
    protected $table         = 'album_saves';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['album_id', 'photo_id'];
    protected $useTimestamps = false;

    public function isSaved(int $photoId, int $albumId): bool
    {
        return $this->where('photo_id', $photoId)
                    ->where('album_id', $albumId)
                    ->countAllResults() > 0;
    }

    public function getAlbumsByPhoto(int $photoId): array
    {
        return $this->db->table('album_saves s')
            ->select('a.*')
            ->join('albums a', 'a.id = s.album_id')
            ->where('s.photo_id', $photoId)
            ->get()
            ->getResultArray();
    }
}