<?php

namespace PHPFramework;

class Application
{

    public static Application $app;
    public Request $request;
    public Response $response;
    public Router $router;

    public function __construct()
    {
        self::$app = $this;
//        dump($_SERVER['QUERY_STRING']);
//        dump($_SERVER['REQUEST_URI']);
//        $this->uri = $_SERVER['QUERY_STRING'];
        $this->request = new Request($_SERVER['REQUEST_URI']);
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        //var_dump($this->uri);
    }

    public function run(): void
    {
        echo $this->router->dispatch();
    }

}
