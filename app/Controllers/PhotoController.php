<?php

namespace App\Controllers;

use App\Models\PhotoModel;
use App\Models\CommentModel;
use App\Models\CategoryModel;

class PhotoController extends BaseController
{
    protected PhotoModel   $photoModel;
    protected CommentModel $commentModel;

    public function __construct()
    {
        $this->photoModel   = new PhotoModel();
        $this->commentModel = new CommentModel();
    }


    public function index()
    {
        return view('photos/index', [
            'title'  => 'Photos',
            'photos' => $this->photoModel->getWithDetails(),
        ]);
    }

    public function show(int $id)
    {
        $photo = $this->photoModel->getOneWithDetails($id);

        if (!$photo) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Photo #$id not found.");
        }

        return view('photos/show', [
            'title'      => $photo['title'] ?? 'Photo',
            'photo'      => $photo,
            'comments'   => $this->commentModel->getByPhoto($id),
            'validation' => \Config\Services::validation(),
        ]);
    }


    public function create()
    {
        return view('photos/create', [
            'title'      => 'Upload Photo',
            'categories' => (new CategoryModel())->findAll(),
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function store()
    {
        if (!$this->validate([
            'category_id' => 'required|is_natural_no_zero',
            'title'       => 'permit_empty|max_length[255]',
            'alt_text'    => 'permit_empty|max_length[255]',
            'image'       => 'uploaded[image]|is_image[image]|max_size[image,5120]',
        ])) {
            return view('photos/create', [
                'title'      => 'Upload Photo',
                'categories' => (new CategoryModel())->findAll(),
                'validation' => $this->validator,
            ]);
        }

        $file    = $this->request->getFile('image');
        $newName = $file->getRandomName();
        $file->move(FCPATH . 'uploads/photos', $newName);

        $this->photoModel->insert([
            'album_id'    => null,
            'category_id' => $this->request->getPost('category_id'),
            'title'       => $this->request->getPost('title'),
            'alt_text'    => $this->request->getPost('alt_text'),
            'image_path'  => 'uploads/photos/' . $newName,
            'file_size'   => $file->getSizeByUnit('kb'),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/photos')->with('success', 'Photo uploaded successfully.');
    }


   
}