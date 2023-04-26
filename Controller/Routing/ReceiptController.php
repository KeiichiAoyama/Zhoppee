<?php
namespace App\Router\Routing;

class ReceiptController {
    public function index() {
        $data = ['title' => 'Login'];
        include __DIR__ . '/../../View/receipt.php';
    }
}
