<?php
namespace App\Router\Routing;

require_once(__DIR__ . '/../../Lib/session.php');
use App\Tools\Session;

class FunctionController{
    public function addToCart(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Session = new Session();
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            if ($data) {
                $Session->add('typeArr', $data['type']);
                $Session->add('prodIDArr', $data['id']);
                $Session->add('amountArr', $data['effectValue']);
                echo 'Order added to cart.';
            } else {
                echo 'No data received.';
            }
        }        
    }

    public function removeRow(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Session = new Session();
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            if ($data) {
                $index = $data['id'];
                $Session->add('index', $index);
                $Session->change('amountArr', $index, 0);
                $Session->change('totalPriceArr', $index, 0);
                echo "row removed";
            } else {
                echo 'No data received.';
            }
        }        
    }

    public function checkout(){
        
    }
}