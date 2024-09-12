<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;

class UserController extends BaseController
{

    public function register()
    {
//        dump(Capsule::insert("insert into users (name, email, password) values (?, ?, ?)", ['Petya', 'petya@mail.com', 'pass3']));

        $users = Capsule::table('users')->select(['id', 'name'])->get();
//        dump($users);

//        $users = Capsule::select('select * from users where id = ?', [3]);
//        dump($users);

//        $user = Capsule::table('users')->select(['id', 'name'])->where('id', 2)->get();
//        $user = Capsule::table('users')->select(['id', 'name'])->where('id', 2)->first();
//        dump($user->name);

        /*$users2 = User::all();
        dump($users2);
        foreach ($users2 as $user) {
            echo $user->name;
        }*/

        /*$users3 = User::query()->select(['id', 'name'])->where('id', '>', 1)->get();
        dump($users3);
        foreach ($users3 as $user) {
            echo $user->name;
        }*/

        return view('user/register', [
            'title' => 'Register page',
            'users' => $users,
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
            /*dump(User::query()->create([
                'name' => $model->attributes['name'],
                'email' => $model->attributes['email'],
                'password' => $model->attributes['password'],
            ]));*/
            //unset($model->attributes['confirmPassword']);
            if ($model->save()) {
                session()->setFlash('success', 'Thanks for registration');
            } else {
                session()->setFlash('error', 'Error registration');
            }
            //dd($model->attributes);
//            session()->setFlash('info', 'Info message...');
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