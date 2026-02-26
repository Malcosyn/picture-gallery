<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlbumModel;
use App\Models\PhotoModel;
use CodeIgniter\HTTP\ResponseInterface;

class AlbumController extends BaseController
{
    public function showAllAlbum()
    {
        return view('albums/index', [
            'title'  => 'Albums',
            'albums' => (new AlbumModel())->orderBy('id', 'ASC')->findAll(),
        ]);
    }

    public function showAlbum($id)
    {
        $albumId = (int) $id;
        $album = (new AlbumModel())->find($albumId);

        if (empty($album)) {
            return redirect()->to('/profile')->with('error', 'Album not found!');
        }

        $photos = (new PhotoModel())->getByAlbum($albumId);

        return view('album/index', [
            'album' => $album,
            'photos' => $photos,
        ]);
    }

    public function searchAlbum()
    {
        $keyword = $this->request->getGet('keyword');
        $albums = (new AlbumModel())->like('title', $keyword)->findAll();

        return view('albums/index', [
            'title'  => 'Albums',
            'albums' => $albums,
        ]);
    }

    public function deleteAlbum() {
        $albumId = $this->request->getPost('album_id');
        $model = new AlbumModel();
        $model->delete($albumId);

        return redirect()->to('/albums')->with('success', 'Album deleted!');
    }

    public function updateAlbum() {
        $albumId = $this->request->getPost('album_id');
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $isPublic = $this->request->getPost('is_public') ? 1 : 0;

        $model = new AlbumModel();
        $model->update($albumId, [
            'title' => $title,
            'description' => $description,
            'is_public' => $isPublic,
        ]);

        return redirect()->to('/profile')->with('success', 'Album updated!');
        
    }

    public function createAlbum() {
        $photographerId = (int) session()->get('user_id');
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $isPublic = $this->request->getPost('is_public') ? 1 : 0;
        $createdAt = date('Y-m-d H:i:s');

        $model = new AlbumModel();
        $model->insert([
            'photographer_id' => $photographerId,
            'title' => $title,
            'description' => $description,
            'is_public' => $isPublic,
            'created_at' => $createdAt,
        ]);

        return redirect()->to('/profile')->with('success', 'Album created!');
    }
}
