<?php

namespace App\Controllers;

class HomeController
{

    public function index()
    {
        return view('test', ['name' => 'John2', 'age' => 35]);
//        app()->view->render('test', ['name' => 'John', 'age' => 35]);
        return 'Test page';
    }

    public function contact()
    {
        return 'Contact page';
    }

}