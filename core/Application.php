<?php

namespace PHPFramework;

class Application
{

    protected string $uri;
    public Request $request;
    public static Application $app;

    public function __construct()
    {
        self::$app = $this;
        $this->uri = $_SERVER['QUERY_STRING'];
        $this->request = new Request($this->uri);
        //var_dump($this->uri);
    }

}
