<?php
namespace App\Router;
require_once(__DIR__ . '/Controller.php');
require_once (__DIR__ . '/../Lib/session.php');

use App\Router\Routing;
use App\Controller;
use App\Tools\Session;

$Session = new Session();
$namespace = 'App\Router\Routing';
$base_dir = __DIR__ . '/Routing';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!($Session->check('typeArr') && is_array($Session->get('typeArr')))
    || !($Session->check('prodIDArr') && is_array($Session->get('prodIDArr')))
    || !($Session->check('amountArr') && is_array($Session->get('amountArr')))
    || !($Session->check('totalPriceArr') && is_array($Session->get('totalPriceArr')))) {
    $Session->setArr('typeArr');
    $Session->setArr('prodIDArr');
    $Session->setArr('amountArr');
    $Session->setArr('totalPriceArr');
}

if (!$Session->check('index')) {
    $Session->setArr('index');
}

spl_autoload_register(function ($class) use ($namespace, $base_dir) {
    $len = strlen($namespace);
    if (strncmp($namespace, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

$request_uri = $_SERVER['REQUEST_URI'];

if (strpos($request_uri, '?') !== false) {
    $request_uri = substr($request_uri, 0, strpos($request_uri, '?'));
}

$segments = explode('/', $request_uri);

$controller = 'login';
$action = 'index';

if (isset($segments[5]) && $segments[5] !== '') {
    $controller = $segments[5];
}

if (isset($segments[6]) && $segments[6] !== '') {
    $action = $segments[6];
}

$controller_class = 'App\\Router\\Routing\\' . ucfirst($controller) . 'Controller';

if (class_exists($controller_class)) {
    $controller_instance = new $controller_class;
    if (method_exists($controller_instance, $action)) {
        $controller_instance->$action();
    } else {
        $error_controller = new Routing\ErrorController();
        $error_controller->actionNotFound();
    }
} else {
    echo $controller_class;
    $error_controller = new Routing\ErrorController();
    $error_controller->controllerNotFound();
}
