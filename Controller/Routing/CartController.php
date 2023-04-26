<?php
namespace App\Router\Routing;

class CartController {
    public function index() {
        $data = ['title' => 'Cart'];
        include __DIR__ . '/../../View/cart.php';
    }
}
