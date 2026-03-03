<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\PhotoModel;
use App\Models\ReportModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function index()
    {
        $reportModel = new ReportModel();
        $userModel = new UserModel();
        $categoryModel = new CategoryModel();

        $reportedPhotos = $reportModel
            ->select('reports.*, photos.title, photos.image_path, photos.id as photo_id')
            ->join('photos', 'photos.id = reports.photo_id', 'left')
            ->orderBy('reports.id', 'DESC')
            ->findAll();

        $users = $userModel
            ->orderBy('id', 'DESC')
            ->findAll();

        $categories = $categoryModel
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('admin/index', [
            'reportedPhotos' => $reportedPhotos,
            'users' => $users,
            'categories' => $categories,
            'reportedCount' => count($reportedPhotos),
            'userCount' => count($users),
            'categoryCount' => count($categories),
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

        if ($section === 'categories') {
            $categoryModel = new CategoryModel();
            $builder = $categoryModel->orderBy('id', 'DESC');

            if ($q !== '') {
                $builder->groupStart()
                    ->like('name', $q)
                    ->orLike('slug', $q)
                    ->groupEnd();
            }

            return $this->response->setJSON([
                'section' => 'categories',
                'data' => $builder->findAll(),
            ]);
        }

        return $this->response->setStatusCode(400)->setJSON([
            'error' => 'Invalid section',
        ]);
    }

    public function storeCategory()
    {
        $categoryModel = new CategoryModel();

        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'slug' => 'required|min_length[2]|max_length[100]|is_unique[categories.slug]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/admin#categories')
                ->withInput()
                ->with('categoryErrors', $this->validator->getErrors());
        }

        $categoryModel->insert([
            'name' => trim((string) $this->request->getPost('name')),
            'slug' => trim((string) $this->request->getPost('slug')),
        ]);

        return redirect()->to('/admin#categories')->with('categorySuccess', 'Category added successfully.');
    }

    public function deleteCategory(int $id)
    {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->find($id);

        if (!$category) {
            return redirect()->to('/admin#categories')->with('categoryError', 'Category not found.');
        }

        $categoryModel->delete($id);

        return redirect()->to('/admin#categories')->with('categorySuccess', 'Category deleted successfully.');
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

    public function deletePhoto(int $id)
    {
        $photoModel = new PhotoModel();
        $photo = $photoModel->find($id);

        if (!$photo) {
            return redirect()->back()->with('error', 'Photo not found.');
        }

        $path = FCPATH . ($photo['image_path'] ?? '');
        if (!empty($photo['image_path']) && is_file($path)) {
            @unlink($path);
        }

        $photoModel->delete($id);

        return redirect()->back()->with('success', 'Photo deleted.');
    }
}
