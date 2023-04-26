<?php
namespace App\Router\Routing;

class CheckoutController {
    public function index() {
        $data = ['title' => 'Checkout'];
        include __DIR__ . '/../../View/checkout.php';
    }
}
