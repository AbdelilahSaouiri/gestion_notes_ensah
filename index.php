<?php

require_once __DIR__ . "/vendor/autoload.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Request-Headers, Authorization");
    header("HTTP/1.1 200 OK");
    exit();
}


$request = $_SERVER['REQUEST_URI'];




switch ($request) {
    case '/':
        include_once './src/public/views/static/login.php';
        break;
    case '/login':
        include_once './src/public/views/static/login.php';
        break;
    case '/login.php':
        include_once './src/public/views/static/login.php';
        break;
    case '/gestion_notes_ensah/':
        include_once './src/public/views/static/login.php';
        break;
    default:
        http_response_code(404);
        include_once './src/public/views/static/404.php';
        break;
}
