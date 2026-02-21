<?php

namespace App\Models;

use CodeIgniter\Model;

class PhotoModel extends Model
{
    protected $table            = 'photos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['album_id', 'category_id', 'image_path', 'title', 'alt_text', 'file_size', 'created_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getWithDetails()
    {
        return $this->db->table('photos p')
            ->select('p.*, a.title as album_title, c.name as category_name')
            ->join('albums a', 'a.id = p.album_id', 'left')
            ->join('categories c', 'c.id = p.category_id')
            ->orderBy('p.id', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getByAlbum(int $albumId)
    {
        return $this->db->table('photos p')
            ->select('p.*, a.title as album_title, c.name as category_name')
            ->join('albums a', 'a.id = p.album_id', 'left')
            ->join('categories c', 'c.id = p.category_id')
            ->where('p.album_id', $albumId)
            ->orderBy('p.id', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getOneWithDetails(int $id)
    {
        return $this->db->table('photos p')
            ->select('p.*, a.title as album_title, c.name as category_name')
            ->join('albums a', 'a.id = p.album_id', 'left')
            ->join('categories c', 'c.id = p.category_id')
            ->where('p.id', $id)
            ->get()
            ->getRowArray();
    }
}
