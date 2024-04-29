<?php

require_once __DIR__ . "/vendor/autoload.php";

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/gestion_notes_ensah/login':
        include_once './src/public/views/static/login.php';
        break;
    case '/gestion_notes_ensah/':
        include_once './src/public/views/static/login.php';
        break;
    default:
        http_response_code(404);
        header("Location:./src/public/views/static/404.php");
        break;
}
