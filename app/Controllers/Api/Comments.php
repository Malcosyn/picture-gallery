<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\PhotoModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Comments extends BaseController
{
    use ResponseTrait;

    protected CommentModel $commentModel;
    protected PhotoModel $photoModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->photoModel = new PhotoModel();
    }

    public function index()
    {
        $photoId = $this->request->getGet('photo_id');

        if ($photoId !== null && !ctype_digit((string) $photoId)) {
            return $this->failValidationErrors(['photo_id' => 'photo_id must be a numeric value.']);
        }

        $comments = $photoId !== null
            ? $this->commentModel->getByPhoto((int) $photoId)
            : $this->commentModel->orderBy('id', 'DESC')->findAll();

        return $this->respond($comments);
    }

    public function show(int $id)
    {
        $comment = $this->commentModel->find($id);

        if (!$comment) {
            return $this->failNotFound("Comment #{$id} not found.");
        }

        return $this->respond($comment);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);
        if (!is_array($data)) {
            $data = $this->request->getPost();
        }

        $rules = [
            'photo_id'    => 'required|is_natural_no_zero',
            'author_name' => 'permit_empty|min_length[2]|max_length[100]',
            'comment'     => 'required|min_length[2]',
        ];

        if (!$this->validateData($data, $rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $photoId = (int) $data['photo_id'];
        if (!$this->photoModel->find($photoId)) {
            return $this->failNotFound("Photo #{$photoId} not found.");
        }

        $payload = [
            'photo_id'    => $photoId,
            'author_name' => $data['author_name'] ?? null,
            'comment'     => $data['comment'],
            'created_at'  => date('Y-m-d H:i:s'),
        ];

        $id = $this->commentModel->insert($payload, true);
        if (!$id) {
            return $this->failServerError('Failed to create comment.');
        }

        $created = $this->commentModel->find((int) $id);

        return $this->respondCreated([
            'message' => 'Comment created.',
            'data'    => $created,
        ]);
    }

    public function delete(int $id)
    {
        $comment = $this->commentModel->find($id);
        if (!$comment) {
            return $this->failNotFound("Comment #{$id} not found.");
        }

        $this->commentModel->delete($id);

        return $this->respond([
            'message' => 'Comment deleted.',
        ], ResponseInterface::HTTP_OK);
    }
}
