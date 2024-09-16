<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;

class UserController extends BaseController
{

    public function register()
    {
        /*Capsule::enableQueryLog();
        $user = User::query()->with('phones')->find(4);
        dump($user);
        dump($user->phones);

        dump(Capsule::getQueryLog());*/

        /*$users = db()->query('select * from users where id > ?', [5])->get();
        dump($users);

        $users = db()->query('select * from users where id > ?', [5])->getAssoc('email');
        dump($users);*/

        /*$user = db()->query('select * from users where id = ?', [5])->get();
        dump($user);

        $user = db()->query('select * from users where id = ?', [5])->getOne();
        dump($user);*/

//        dump(db()->query('select count(*) from users')->getOne());
//        dump(db()->query('select count(*) from users')->getColumn());

//        $users = db()->findAll('users');
//        dump($users);

//        $user = db()->findOne('users', 'nizyw@mailinator.com', 'email');
//        dump($user);

//        $user = db()->findOrFail('users', 'nizyw@mailinator.com', 'email');
//        dump($user);

//        db()->query('insert into phones (user_id, phone) values (?, ?)', [5, 5111]);
//        dump(db()->getInsertId());

//        db()->query('delete from phones where id > ?', [6]);
//        dump(db()->rowCount());

        try {
            db()->beginTransaction();
            db()->query('insert into phones (user_id, phone) values (?,?)', [10, 10111]);
            db()->query('insert into users (name, email, password) values (?,?,?)', ['User 10', 'user10@mail.com', 111]);
            db()->commit();
        } catch (\PDOException $e) {
            db()->rollBack();
            dump($e);
        }


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