<?php

namespace PHPFramework;

class Response
{

    public function redirect(string $url, int $code = 302): void
    {
        http_response_code($code);
        header("Location: $url");
        exit;
    }

}