<?php

namespace PHPFramework;

class Application
{

    protected string $uri;
    public Request $request;
    public Response $response;
    public Router $router;
    public static Application $app;

    public function __construct()
    {
        self::$app = $this;
//        dump($_SERVER['QUERY_STRING']);
//        dump($_SERVER['REQUEST_URI']);
//        $this->uri = $_SERVER['QUERY_STRING'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->request = new Request($this->uri);
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        //var_dump($this->uri);
    }

    public function run(): void
    {
        echo $this->router->dispatch();
    }

}
