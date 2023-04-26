<?php
namespace App\Router\Routing;

class ErrorController{
    public function controllerNotFound() {
        $data = ['title' => 'Home'];
        include __DIR__ . '/../../View/404.php';
    }
}