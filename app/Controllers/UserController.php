<?php

namespace App\Controllers;

use App\Models\User;
use PHPFramework\Auth;
use PHPFramework\Pagination;

class UserController extends BaseController
{

    public function register()
    {
//        db()->query('insert into phones (user_id, phone) values (?,?)', [10, 10111]);
        /*try {
            db()->beginTransaction();
            db()->query('insert into phones (user_id, phone) values (?,?)', [10, 10111]);
            db()->query('insert into users (name, email, password) values (?,?,?)', ['User 10', 'user10@mail.com', 111]);
            db()->commit();
        } catch (\PDOException $e) {
            db()->rollBack();
            dump($e);
        }*/


        return view('user/register', [
            'title' => 'Register page',
        ]);
    }

    public function store()
    {
        $model = new User();
        $model->loadData();

        if (request()->isAjax()) {
            if (!$model->validate()) {
                echo json_encode(['status' => 'error', 'data' => $model->listErrors()]);
                die;
            }

            $model->attributes['password'] = password_hash($model->attributes['password'], PASSWORD_DEFAULT);
            if ($id = $model->save()) {
                echo json_encode(['status' => 'success', 'data' => sprintf(__('user_store_success'), $id), 'redirect' => base_href('/login')]);
            } else {
                echo json_encode(['status' => 'error', 'data' => 'Error registration']);
            }
            die;
        }

        if (!$model->validate()) {
            session()->setFlash('error', 'Validation errors');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        } else {
            $model->attributes['password'] = password_hash($model->attributes['password'], PASSWORD_DEFAULT);
            if ($id = $model->save()) {
                session()->setFlash('success', 'Thanks for registration. Your ID: ' . $id);
            } else {
                session()->setFlash('error', 'Error registration');
            }

        }
        response()->redirect('/register');
    }

    public function login()
    {
        /*$credentials = [
            'email' => 'admin2@mail.com',
            'password' => '123',
        ];

        dump($credentials);
        $password = $credentials['password'];
        unset($credentials['password']);
        $field = array_key_first($credentials);
        $value = $credentials[$field];
        dump($field);
        dump($value);
        dump($password);

        $user = db()->findOne('users', $value, $field);
        dump($user);*/

        return view('user/login', [
            'title' => 'Login page',
        ]);
    }

    public function auth()
    {
        $model = new User();
        $model->loadData();

        if (!$model->validate($model->attributes, [
            'required' => ['email', 'password'],
        ])) {
            echo json_encode(['status' => 'error', 'data' => $model->listErrors()]);
            die;
        }

        if (Auth::login([
            'email' => $model->attributes['email'],
            'password' => $model->attributes['password'],
        ])) {
            echo json_encode(['status' => 'success', 'data' => 'Success login', 'redirect' => base_href('/dashboard')]);
        } else {
            echo json_encode(['status' => 'error', 'data' => 'Wrong email or password']);
        }
        die;
    }

    public function logout()
    {
        Auth::logout();
        response()->redirect(base_href('/login'));
    }

    public function index()
    {
        /*if ($page = cache()->get(request()->rawUri)) {
            return $page;
        }*/

        $users_cnt = db()->query("select count(*) from users")->getColumn();
        $limit = PAGINATION_SETTINGS['perPage'];
//        $limit = 5;
        $pagination = new Pagination($users_cnt, $limit, tpl: 'pagination/base2', midSize: 3);

        $users = db()->query("select * from users limit $limit offset {$pagination->getOffset()}")->get();

        /*$page = view('user/index', [
            'title' => 'Users',
            'users' => $users,
            'pagination' => $pagination,
        ]);

        cache()->set(request()->rawUri, $page);
        return $page;*/

        return view('user/index', [
            'title' => 'Users',
            'users' => $users,
            'pagination' => $pagination,
        ]);
    }

}