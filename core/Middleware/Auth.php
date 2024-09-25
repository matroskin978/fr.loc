<?php

namespace PHPFramework\Middleware;

class Auth
{

    public function handle(): void
    {
        if (!check_auth()) {
            session()->setFlash('error', 'Forbidden');
            response()->redirect(base_url('/login'));
        }
    }

}