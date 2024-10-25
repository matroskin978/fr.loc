<?php

namespace App\Controllers;

class HomeController extends BaseController
{

    public function index()
    {
        return view('home/index', [
            'title' => 'Home page',
        ]);
    }

    function dashboard()
    {
        return view('dashboard', [
            'title' => 'Dashboard page',
        ]);
    }

    public function contact()
    {
        return 'Contact page';
    }

}