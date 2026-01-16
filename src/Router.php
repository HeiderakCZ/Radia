<?php

declare(strict_types=1);

class Router
{
    /**
     * @var array<string, callable>
     */
    private array $routes = [];

    public function get(string $path, callable $handler): void
    {
        $this->routes['GET ' . $this->normalizePath($path)] = $handler;
    }

    public function dispatch(string $method, string $uriPath): void
    {
        $path = $this->normalizePath($uriPath);
        $key = $method . ' ' . $path;

        if (!array_key_exists($key, $this->routes)) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        ($this->routes[$key])();
    }

    private function normalizePath(string $path): string
    {
        $normalized = '/' . trim($path, '/');
        return $normalized === '/' ? '/' : rtrim($normalized, '/');
    }
}
