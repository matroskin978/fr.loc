<?php

namespace App\Controllers;

use PHPFramework\File;

class TestController
{

    public function index()
    {
        return view('test/index', [
            'title' => 'Test page'
        ]);
    }

    public function send()
    {
        $file = new File('my-file');
        dump($file->save());
    }

}