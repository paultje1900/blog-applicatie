<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\Validator;

class AuthController
{

    public function loginForm(): void
    {
        render('auth/login');
    }

    public function login(): void
    {
        Csrf::verify($_POST['_token'] ?? '');

        $validator = new Validator($_POST, [
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            Session::setOld($_POST);
            Session::flash('errors', $validator->errors());
            redirect('/login');
        }

        if (!Auth::attempt($_POST['email'], $_POST['password'])) {
            Session::setOld($_POST);
            Session::flash('error', 'Ongeldige inloggegevens.');
            redirect('/login');
        }

        redirect('/');
    }

    public function registerForm(): void
    {
        render('auth/register');
    }

    public function register(): void
    {
        Csrf::verify($_POST['_token'] ?? '');

        $validator = new Validator($_POST, [
            'username'     => ['required', 'min:2', 'max:255'],
            'email'    => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) {
            Session::setOld($_POST);
            Session::flash('errors', $validator->errors());
            redirect('/register');
        }

        $existing = \App\Core\Database::query(
            "SELECT id FROM users WHERE email = ?",
            [$_POST['email']]
        )->fetch();

        if ($existing) {
            Session::setOld($_POST);
            Session::flash('error', 'Dit e-mailadres is al in gebruik.');
            redirect('/register');
        }

        Auth::register($_POST['username'], $_POST['email'], $_POST['password']);

        redirect('/');
    }

    public function logout(): void
    {
        Auth::logout();
        redirect('/login');
    }
}