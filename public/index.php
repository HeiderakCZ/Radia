<?php

declare(strict_types=1);

require __DIR__ . '/../src/Router.php';

$router = new Router();

$router->get('/', function (): void {
    echo 'Frontend home';
});

$router->get('/about', function (): void {
    echo 'Frontend about';
});

$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/');
