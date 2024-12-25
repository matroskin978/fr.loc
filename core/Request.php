<?php

namespace PHPFramework;

class Request
{

    public string $uri;
    public string $rawUri;

    public array $post;
    public array $get;
    public array $files;

    public function __construct($uri)
    {
        $this->rawUri = $uri;
        $this->uri = trim(urldecode($uri), '/');
        $this->post = $_POST;
        $this->get = $_GET;
        $this->files = $_FILES;
    }

    public function getMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(): bool
    {
        return $this->getMethod() == 'GET';
    }

    public function isPost(): bool
    {
        return $this->getMethod() == 'POST';
    }

    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function get($name, $default = null): ?string
    {
        return $this->get[$name] ?? $default;
    }

    public function post($name, $default = null): ?string
    {
        return $this->post[$name] ?? $default;
    }

    public function getPath(): string
    {
        return $this->removeQueryString();
    }

    protected function removeQueryString(): string
    {
        if ($this->uri) {
            $params = explode("?", $this->uri);
            return trim($params[0], '/');
        }
        return "";
    }

    public function getData(): array
    {
        $data = [];
        $request_data = $this->isPost() ? $_POST : $_GET;
        foreach ($request_data as $k => $v) {
            if (is_string($v)) {
                $v = trim($v);
            }
            $data[$k] = $v;
        }
        return $data;
    }

}