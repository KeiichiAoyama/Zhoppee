<?php
namespace App\Router\Routing;

class HomeController {
    public function index() {
        $data = ['title' => 'Home'];
        include __DIR__ . '/../../View/index.php';
    }
}

