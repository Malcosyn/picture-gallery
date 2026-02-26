<?php

namespace App\Controllers;

use App\Models\ReportModel;
use App\Models\PhotoModel;

class ReportController extends BaseController
{
    protected ReportModel $reportModel;
    protected PhotoModel  $photoModel;

    public function __construct()
    {
        $this->reportModel = new ReportModel();
        $this->photoModel  = new PhotoModel();
    }

    public function create(int $photoId)
    {
        $photo = $this->photoModel->find($photoId);

        if (!$photo) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Photo #$photoId not found.");
        }

        return view('reports/create', [
            'title'      => 'Report Photo',
            'photo'      => $photo,
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function store(int $photoId)
    {
        $photo = $this->photoModel->find($photoId);

        if (!$photo) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Photo #$photoId not found.");
        }

        if (!$this->validate([
            'reason' => 'required|min_length[5]|max_length[255]',
        ])) {
            return view('reports/create', [
                'title'      => 'Report Photo',
                'photo'      => $photo,
                'validation' => $this->validator,
            ]);
        }

        $this->reportModel->insert([
            'photo_id'   => $photoId,
            'reason'     => $this->request->getPost('reason'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to("/photos/{$photoId}")->with('success', 'Photo reported successfully.');
    }
}