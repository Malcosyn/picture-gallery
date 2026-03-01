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

   public function addToAlbum(int $photoId)
    {
        $photoModel = new PhotoModel();
        $photo = $photoModel->find($photoId);

        if (!$photo) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Photo #$photoId not found.");
        }

        $albumSaveModel = new \App\Models\AlbumSaveModel();

        // Get user's albums and mark which ones already contain this photo
        $albums = (new AlbumModel())
            ->where('photographer_id', session()->get('user_id'))
            ->findAll();

        foreach ($albums as &$album) {
            $album['is_saved'] = $albumSaveModel->isSaved($photoId, $album['id']);
        }

        return view('album/add_to_album', [
            'title'  => 'Add to Album',
            'photo'  => $photo,
            'albums' => $albums,
        ]);
    }

    public function saveToAlbum(int $photoId)
    {
        $photoModel     = new PhotoModel();
        $albumSaveModel = new \App\Models\AlbumSaveModel();

        $photo = $photoModel->find($photoId);

        if (!$photo) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Photo #$photoId not found.");
        }

        $albumId = (int) $this->request->getPost('album_id');

        // Verify album belongs to logged in user
        $album = (new AlbumModel())->where('id', $albumId)
                                ->where('photographer_id', session()->get('user_id'))
                                ->first();

        if (!$album) {
            return redirect()->to("/photos/{$photoId}")->with('error', 'Album not found.');
        }

        // Prevent duplicates
        if ($albumSaveModel->isSaved($photoId, $albumId)) {
            return redirect()->to("/photos/{$photoId}")->with('error', 'Photo is already in that album.');
        }

        $albumSaveModel->insert([
            'photo_id' => $photoId,
            'album_id' => $albumId,
        ]);

        return redirect()->to("/photos/{$photoId}")->with('success', 'Photo added to album!');
    }

    public function removeFromAlbum(int $photoId)
    {
        $albumSaveModel = new \App\Models\AlbumSaveModel();

        $albumId = (int) $this->request->getPost('album_id');

        $albumSaveModel->where('photo_id', $photoId)
                    ->where('album_id', $albumId)
                    ->delete();

        return redirect()->to("/photos/{$photoId}")->with('success', 'Photo removed from album.');
    }
}
