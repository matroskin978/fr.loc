<?php

namespace App\Controllers;

use PHPFramework\Controller;

class BaseController extends Controller
{

    public function __construct()
    {
        /*if (!$menu = cache()->get('menu')) {
            cache()->set('menu', $this->renderMenu(), 1);
        }*/
    }

    public function renderMenu(): string
    {
        return view()->renderPartial('incs/menu');
    }

}