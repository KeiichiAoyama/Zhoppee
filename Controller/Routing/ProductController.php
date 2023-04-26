<?php
namespace App\Router\Routing;

class ProductController {
    public function index() {
        include __DIR__ . '/../../View/product.php';
    }
}
