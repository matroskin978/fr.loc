<?php

namespace PHPFramework;

class Router
{
//    protected Request $request;
//    protected Response $response;

    protected array $routes = [];
    protected array $route_params = [];

    /*public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }*/

    public function __construct(
        protected Request $request,
        protected Response $response
    )
    {
    }

    public function add(string $path, \Closure|array $callback, string|array $method, $middleware = null, bool $needToken = true): static
    {
        $method = (array) $method;
        $this->routes[] = [
            'path' => '/' . trim($path, '/'),
            'callback' => $callback,
            'method' => array_map('strtoupper', $method),
            'middleware' => $middleware,
            'needToken' => $needToken
        ];
        return $this;
    }

    public function get($path, $callback): self
    {
        return $this->add($path, $callback, 'GET');
    }

    public function post($path, $callback): self
    {
        return $this->add($path, $callback, 'POST');
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function dispatch(): mixed
    {
        $path = $this->request->getPath();
        $route = $this->matchRoute($path);
        if (false === $route) {
            http_response_code(404);
            echo '404 - Page not found';
            die;
        }

        if (is_array($route['callback'])) {
            $route['callback'][0] = new $route['callback'][0];
        }

        return call_user_func($route['callback']);
    }

    protected function matchRoute($path): mixed
    {
        foreach ($this->routes as $route) {
            if (
                preg_match("#^{$route['path']}$#", "/{$path}", $matches)
                &&
                in_array($this->request->getMethod(), $route['method'])
            ) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $this->route_params[$k] = $v;
                    }
                }
                return $route;
            }
        }
        return false;
    }

}