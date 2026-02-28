<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReportModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function index()
    {
        $reportModel = new ReportModel();
        $userModel = new UserModel();

        $reportedPhotos = $reportModel
            ->select('reports.*, photos.title, photos.image_path, photos.id as photo_id')
            ->join('photos', 'photos.id = reports.photo_id', 'left')
            ->orderBy('reports.id', 'DESC')
            ->findAll();

        $users = $userModel
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('admin/index', [
            'reportedPhotos' => $reportedPhotos,
            'users' => $users,
            'reportedCount' => count($reportedPhotos),
            'userCount' => count($users),
        ]);
    }

    public function search()
    {
        $section = $this->request->getGet('section');
        $q = trim((string) $this->request->getGet('q'));

        if ($section === 'reports') {
            $reportModel = new ReportModel();
            $builder = $reportModel
                ->select('reports.*, photos.title, photos.image_path, photos.id as photo_id')
                ->join('photos', 'photos.id = reports.photo_id', 'left')
                ->orderBy('reports.id', 'DESC');

            if ($q !== '') {
                $builder->groupStart()
                    ->like('reports.reason', $q)
                    ->orLike('reports.created_at', $q)
                    ->orLike('photos.title', $q)
                    ->groupEnd();
            }

            return $this->response->setJSON([
                'section' => 'reports',
                'data' => $builder->findAll(),
            ]);
        }

        if ($section === 'users') {
            $userModel = new UserModel();
            $builder = $userModel->orderBy('id', 'DESC');

            if ($q !== '') {
                $builder->groupStart()
                    ->like('username', $q)
                    ->orLike('email', $q)
                    ->orLike('created_at', $q)
                    ->groupEnd();
            }

            return $this->response->setJSON([
                'section' => 'users',
                'data' => $builder->findAll(),
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'error' => 'Invalid section',
        ]);
    }

    public function userDetail(int $id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return $this->response->setStatusCode(404)->setBody('User not found');
        }

        return view('admin/user_detail', [
            'user' => $user,
        ]);
    }

    public function deleteUser(int $id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $userModel->delete($id);

        return redirect()->back()->with('success', 'User deleted.');
    }

    public function updateUser(int $id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $rules = [
            'username' => 'required',
            'email' => 'required|valid_email',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
        ];

        $password = (string) $this->request->getPost('password');
        if ($password !== '') {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);

        return redirect()->back()->with('success', 'User updated.');
    }
}
