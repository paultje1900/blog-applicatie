<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Session;
use App\Core\Validator;
use App\Models\UserModel;

class AuthController
{

    public function loginForm(): void
    {
        if (Auth::check()) {
            redirect('/');
        }

        render('auth/login');
    }

    public function registerForm(): void
    {
        if (Auth::check()) {
            redirect('/');
        }

        render('auth/register');
    }

    public function login(): void
    {
        Csrf::verify();

        $validator = new Validator($_POST, [
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            Session::setOld($_POST);
            redirect('/login');
            return;
        }

        if (!Auth::attempt($_POST['email'], $_POST['password'])) {
            Session::flash('error', 'Ongeldige inloggegevens.');
            Session::setOld($_POST);
            redirect('/login');
            return;
        }

        Session::flash('success', 'Welkom terug!');
        redirect('/');
    }

    public function register(): void
    {
        Csrf::verify();

        $validator = new Validator($_POST, [
            'username' => ['required', 'min:2', 'max:50'],
            'email'    => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            Session::setOld($_POST);
            redirect('/register');
            return;
        }

        // Check of email al in gebruik is
        if (UserModel::emailExists($_POST['email'])) {
            Session::flash('error', 'Dit e-mailadres is al in gebruik.');
            Session::setOld($_POST);
            redirect('/register');
            return;
        }

        Auth::register($_POST['username'], $_POST['email'], $_POST['password']);

        Session::flash('success', 'Account aangemaakt!');
        redirect('/');
    }

    public function logout(): void
    {
        Csrf::verify();
        Auth::logout();
        Session::flash('success', 'Je bent uitgelogd.');
        redirect('/login');
    }
}