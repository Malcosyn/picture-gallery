<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    protected CategoryModel $model;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    public function index()
    {
        return view('categories/index', [
            'title'      => 'Categories',
            'categories' => $this->model->orderBy('id', 'ASC')->findAll(),
        ]);
    }

    public function show(int $id)
    {
        $category = $this->model->find($id);

        if (!$category) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Category #$id not found.");
        }

        return view('categories/show', [
            'title'    => $category['name'],
            'category' => $category,
        ]);
    }

        public function create()
    {
        return view('categories/create', [
            'title'      => 'Add Category',
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function store()
    {
        if (!$this->validate([
            'name' => 'required|min_length[2]|max_length[100]',
            'slug' => 'required|min_length[2]|max_length[100]|is_unique[categories.slug]',
        ])) {
            return view('categories/create', [
                'title'      => 'Add Category',
                'validation' => $this->validator,
            ]);
        }

        $this->model->insert([
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
        ]);

        return redirect()->to('/categories')->with('success', 'Category added successfully.');
    }
}