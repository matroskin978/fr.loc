<?php

namespace PHPFramework;

class Router
{

    protected array $routes = [];
    public array $route_params = [];


    public function __construct(
        protected Request $request,
        protected Response $response
    )
    {
    }

    public function add($path, $callback, $method): self
    {
        $path = trim($path, '/');
        if (is_array($method)) {
            $method = array_map('strtoupper', $method);
        } else {
            $method = [strtoupper($method)];
        }

        $this->routes[] = [
            'path' => "/$path",
            'callback' => $callback,
            'middleware' => [],
            'method' => $method,
            'needCsrfToken' => true,
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

    public function put($path, $callback): self
    {
        return $this->add($path, $callback, 'PUT');
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
            abort('Test 404 error');
        }

        if (is_array($route['callback'])) {
            $route['callback'][0] = new $route['callback'][0];
        }

        return call_user_func($route['callback']);
    }

    protected function matchRoute($path): mixed
    {
        $allowed_methods = [];
        foreach ($this->routes as $route) {
            if (MULTILANGS) {
                $pattern = "#^/?(?P<lang>[a-z]+)?{$route['path']}?$#"; // "/users"
            } else {
                $pattern = "#^{$route['path']}$#";
            }
            if (
                preg_match($pattern, "/{$path}", $matches)
                //&&
                //in_array($this->request->getMethod(), $route['method'])
            ) {

                if (!in_array($this->request->getMethod(), $route['method'])) {
                    $allowed_methods = array_merge($allowed_methods, $route['method']);
                    continue;
                }

                /*if (!in_array($this->request->getMethod(), $route['method'])) {
                    if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
                        response()->json(['status' => 'error', 'answer' => 'Method not allowed'], 405);
                    }
                    abort('Method Not Allowed', 405);
                }*/

                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $this->route_params[$k] = $v;
                    }
                }

                // если язык есть, но его нет в массиве допустимых - 404
                // если язык есть, но это базовый язык - 404
                $lang = trim(get_route_param('lang'), '/');
                $base_lang = array_value_search(LANGS, 'base', 1);
                if ( ($lang && !array_key_exists($lang, LANGS)) || $lang == $base_lang ) {
                    abort();
                }

                $lang = $lang ?: $base_lang;
                app()->set('lang', LANGS[$lang]);
                Language::load($route['callback']);

                if (request()->isPost()) {
                    if ($route['needCsrfToken'] && !$this->checkCsrfToken()) {
                        if (request()->isAjax()) {
                            echo json_encode([
                                'status' => 'error',
                                'data' => 'Security error',
                            ]);
                            die;
                        } else {
                            abort('Page expired', 419);
                        }
                    }
                }

                if ($route['middleware']) {
                    foreach ($route['middleware'] as $item) {
                        $middleware = MIDDLEWARE[$item] ?? false;
                        if ($middleware) {
                            (new $middleware)->handle();
                        }
                    }
                }


                return $route;
            }
        }

        if ($allowed_methods) {
            header("Allow: " . implode(', ', array_unique($allowed_methods)));
            if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
                response()->json(['status' => 'error', 'answer' => 'Method not allowed'], 405);
            }
            abort('Method Not Allowed', 405);
        }

        return false;
    }

    public function withoutCsrfToken(): self
    {
        $this->routes[array_key_last($this->routes)]['needCsrfToken'] = false;
        return $this;
    }

    public function checkCsrfToken(): bool
    {
        return request()->post('csrf_token') && (request()->post('csrf_token') == session()->get('csrf_token'));
    }

    public function middleware(array $middleware): self
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
        return $this;
    }

}