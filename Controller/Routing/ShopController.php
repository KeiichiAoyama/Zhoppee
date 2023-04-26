<?php
namespace App\Router\Routing;

class ShopController {
    public function manga() {
        $data = ['title' => 'Shop',
                 'type' => 1];
        include __DIR__ . '/../../View/shop.php';
    }

    public function lightnovel() {
        $data = ['title' => 'Shop',
                 'type' => 2];
        include __DIR__ . '/../../View/shop.php';
    }

    public function merch() {
        $data = ['title' => 'Shop',
                 'type' => 3];
        include __DIR__ . '/../../View/shop.php';
    }
}
