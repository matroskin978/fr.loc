<?php

namespace App\Controllers;

use App\Models\User;
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
                echo json_encode(['status' => 'success', 'data' => 'Thanks for registration. Your ID: ' . $id, 'redirect' => base_url('/login')]);
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
        return view('user/login', [
            'title' => 'Login page',
            'styles' => [
                base_url('/assets/css/test.css'),
            ],
            'header_scripts' => [
                base_url('/assets/js/test.js'),
                base_url('/assets/js/test2.js'),
            ],
            'footer_scripts' => [
                base_url('/assets/js/test3.js'),
            ],
        ]);
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