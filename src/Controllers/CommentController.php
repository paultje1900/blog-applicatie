<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\Validator;
use App\Models\CommentModel;
use App\Models\PostModel;

class CommentController
{
    public function store(string $postId): void
    {
        Csrf::verify();

        $post = PostModel::findById((int) $postId);
        if (!$post) {
            http_response_code(404);
            render('errors/404');
            return;
        }

        $validator = new Validator($_POST, [
            'body' => ['required', 'max:2000'],
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            Session::setOld($_POST);
            redirect("/posts/{$postId}");
            return;
        }

        CommentModel::create([
            'post_id' => (int) $postId,
            'user_id' => Auth::user()['id'],
            'body'    => $_POST['body'],
        ]);

        Session::flash('success', 'Reactie geplaatst!');
        redirect("/posts/{$postId}");
    }

    public function storeApi(string $postId): void
    {
        header('Content-Type: application/json');

        $token = $_POST['_token'] ?? '';
        $sessionToken = Session::get('_token') ?? '';

        if (!hash_equals(trim($sessionToken), trim($token))) {
            http_response_code(403);
            echo json_encode(['error' => 'CSRF token mismatch.']);
            return;
        }

        if (!Auth::check()) {
            http_response_code(401);
            echo json_encode(['error' => 'Je moet ingelogd zijn om te reageren.']);
            return;
        }

        $post = PostModel::findById((int) $postId);
        if (!$post) {
            http_response_code(404);
            echo json_encode(['error' => 'Post niet gevonden.']);
            return;
        }

        $validator = new Validator($_POST, [
            'body' => ['required', 'max:2000'],
        ]);

        if ($validator->fails()) {
            http_response_code(422);
            echo json_encode(['errors' => $validator->errors()]);
            return;
        }

        $commentId = CommentModel::create([
            'post_id' => (int) $postId,
            'user_id' => Auth::user()['id'],
            'body'    => $_POST['body'],
        ]);

        $comment = CommentModel::findById((int) $commentId);
        $user = Auth::user();

        echo json_encode([
            'id'         => (int) $comment['id'],
            'author'     => $user['username'],
            'content'    => $comment['body'],
            'created_at' => $comment['created_at'],
        ]);
    }
}