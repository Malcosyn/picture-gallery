<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\PhotoModel;

class CommentController extends BaseController
{
    protected CommentModel $commentModel;
    protected PhotoModel   $photoModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->photoModel   = new PhotoModel();
    }

    public function store(int $photoId)
    {
        // Make sure the photo exists
        if (!$this->photoModel->find($photoId)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Photo #$photoId not found.");
        }

        if (!$this->validate([
            'author_name' => 'required|min_length[2]|max_length[100]',
            'comment'     => 'required|min_length[2]',
        ])) {
            return redirect()
                ->to("/photos/{$photoId}")
                ->withInput()
                ->with('comment_errors', $this->validator->getErrors());
        }

        $this->commentModel->insert([
            'photo_id'    => $photoId,
            'author_name' => $this->request->getPost('author_name'),
            'comment'     => $this->request->getPost('comment'),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to("/photos/{$photoId}")->with('success', 'Comment added.');
    }

    public function delete(int $commentId)
    {
        $comment = $this->commentModel->find($commentId);

        if (!$comment) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Comment #$commentId not found.");
        }

        $this->commentModel->delete($commentId);

        return redirect()->to("/photos/{$comment['photo_id']}")->with('success', 'Comment deleted.');
    }
}