<?php

namespace App\Controllers;

class ContactController extends BaseController
{

    public function index()
    {
        dump(send_mail(
            ['test@mail.com'],
            'Тест 1',
            'mail/test',
            ['name' => 'Джон', 'age' => 35],
            [WWW . '/img/cake.jpg']
        ));
        return view('contact/index', [
            'title' => 'Contact page',
        ]);
    }


}