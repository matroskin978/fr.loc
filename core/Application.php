<?php

namespace PHPFramework;

use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{

    protected string $uri;
    public Request $request;
    public Response $response;
    public Router $router;
    public View $view;
    public Session $session;
    public Database $db;
    public static Application $app;

    public function __construct()
    {
        self::$app = $this;
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->request = new Request($this->uri);
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View(LAYOUT);
        $this->session = new Session();
        $this->generateCsrfToken();
        //$this->setDbConnection();
        $this->db = new Database();
    }

    public function run(): void
    {
        echo $this->router->dispatch();
    }

    public function generateCsrfToken(): void
    {
        if (!session()->has('csrf_token')) {
            session()->set('csrf_token', md5(uniqid(mt_rand(), true)));
        }
    }

    public function setDbConnection()
    {
        $capsule = new Capsule();
        $capsule->addConnection(DB_SETTINGS);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}
