<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{

    public function register()
    {
        return view('user/register', [
            'title' => 'Register page',
        ]);
    }

    public function store()
    {
        $model = new User();
        $model->loadData();
        if (!$model->validate()) {
            session()->setFlash('error', 'Validation errors');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
//            session()->setFlash('info', 'Info message...');
            session()->setFlash('success', 'Successfully Validation');
        }
        response()->redirect('/register');
//        dump($model->attributes);
//        dump($model->validate());
//        dump($model->getErrors());
//        dd($_POST);
    }

    public function login()
    {
        return view('user/login', [
            'title' => 'Login page',
        ]);
    }

}