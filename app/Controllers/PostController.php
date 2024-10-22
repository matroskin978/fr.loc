<?php

namespace App\Controllers;

use App\Models\User;

class PostController extends BaseController
{

    public function index()
    {
//        dump(app()->get('lang'));

        $posts = db()->query("select p.*, pd.* from posts p join posts_description pd on p.id = pd.post_id where pd.lang_id = ?", [app()->get('lang')['id']])->get();

        return view('post/index', [
            'title' => 'Список статей',
            'posts' => $posts,
        ]);
    }

}