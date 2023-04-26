<?php
namespace App\Router\Routing;

class RegisterController {
    public function index() {
        $data = ['title' => 'Register'];
        include __DIR__ . '/../../View/register.php';
    }
}
