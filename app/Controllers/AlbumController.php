<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlbumModel;
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
}
