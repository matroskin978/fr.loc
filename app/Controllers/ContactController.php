<?php

namespace App\Controllers;

use PHPFramework\File;

class ContactController extends BaseController
{

    public function index()
    {
        /*dump(send_mail(
            ['test@mail.com'],
            'Тест 1',
            'mail/test',
            ['name' => 'Джон', 'age' => 35],
            [WWW . '/img/cake.jpg']
        ));*/
        return view('contact/index', [
            'title' => 'Contact page',
        ]);
    }

    public function send()
    {
        $file = new File('my-file');
        $file_url = $file->save();
        if (send_mail(
            ['test@mail.com'],
            'Send contact form',
            'mail/test',
            [
                'name' => request()->post('name'),
                'message' => request()->post('message'),
            ],
            $file_url ? [WWW . $file_url] : []
        )) {
            File::remove(WWW . $file_url);
            session()->setFlash('success', 'Message sent');
        } else {
            session()->setFlash('error', 'Error sending');
        }
        response()->redirect(base_href('/contact'));
    }


}