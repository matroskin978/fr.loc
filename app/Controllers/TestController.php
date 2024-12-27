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
        /*for ($i = 0; $i < count(request()->files['my-files']['name']); $i++) {
            $files = new File("my-files.{$i}");
            dump($files->save());
        }*/

        $file = new File('my-file');
        dump($file->save());
    }

}