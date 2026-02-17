<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\Validator;
use App\Models\CommentModel;
use App\Models\PostModel;

class PostController
{
    public function index(): void
    {
        $posts = PostModel::findAllWithAuthor();

        render('posts/index', [
            'posts' => $posts,
            'user'  => Auth::user(),
        ]);
    }

    public function create(): void
    {
        render('posts/create', [
            'user' => Auth::user(),
        ]);
    }

    public function store(): void
    {
        Csrf::verify();

        $validator = new Validator($_POST, [
            'title' => ['required', 'max:255'],
            'body'  => ['required'],
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            Session::setOld($_POST);
            redirect('/posts/create');
            return;
        }

        $id = PostModel::create([
            'user_id' => Auth::user()['id'],
            'title'   => $_POST['title'],
            'body' => strip_tags($_POST['body'], '<p><div><h2><h3><strong><em><u><s><b><i><strike><ul><ol><li><blockquote><br>'),
        ]);

        Session::flash('success', 'Post aangemaakt!');
        redirect("/posts/{$id}");
    }

    public function show(string $id): void
    {
        $post = PostModel::findByIdWithAuthor((int) $id);

        if (!$post) {
            http_response_code(404);
            render('errors/404');
            return;
        }

        $comments = CommentModel::findByPostId((int) $id);

        render('posts/show', [
            'post' => $post,
            'comments' => $comments,
            'user' => Auth::user(),
        ]);
    }

    public function edit(string $id): void
    {
        $post = PostModel::findByIdWithAuthor((int) $id);

        if (!$post) {
            http_response_code(404);
            render('errors/404');
            return;
        }

        if ($post['user_id'] !== Auth::user()['id']) {
            http_response_code(403);
            render('errors/403');
            return;
        }

        render('posts/edit', [
            'post' => $post,
            'user' => Auth::user(),
        ]);
    }

    public function update(string $id): void
    {
        Csrf::verify();

        $post = PostModel::findByIdWithAuthor((int) $id);

        if (!$post) {
            http_response_code(404);
            render('errors/404');
            return;
        }

        if ($post['user_id'] !== Auth::user()['id']) {
            http_response_code(403);
            render('errors/403');
            return;
        }

        $validator = new Validator($_POST, [
            'title' => ['required', 'max:255'],
            'body'  => ['required'],
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            Session::setOld($_POST);
            redirect("/posts/{$id}/edit");
            return;
        }

        PostModel::update((int) $id, [
            'title' => $_POST['title'],
            'body' => strip_tags($_POST['body'], '<p><div><h2><h3><strong><em><u><s><b><i><strike><ul><ol><li><blockquote><br>'),
        ]);

        Session::flash('success', 'Post bijgewerkt!');
        redirect("/posts/{$id}");
    }

    public function destroy(string $id): void
    {
        Csrf::verify();

        $post = PostModel::findByIdWithAuthor((int) $id);

        if (!$post) {
            http_response_code(404);
            render('errors/404');
            return;
        }

        if ($post['user_id'] !== Auth::user()['id']) {
            http_response_code(403);
            render('errors/403');
            return;
        }

        PostModel::delete((int) $id);

        Session::flash('success', 'Post verwijderd!');
        redirect('/');
    }
}