<?php
namespace App\Router\Routing;

class LoginController {
    public function index() {
        $data = ['title' => 'Login'];
        include __DIR__ . '/../../View/login.php';
    }
}
