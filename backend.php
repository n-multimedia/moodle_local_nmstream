<?php

namespace local_nmstream;

require_once('classes/HTTPController.php');

$controller = new HTTPController();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'PUT':
        $response = $controller->handlePut($_POST);
        break;
    case 'GET':
        $response = $controller->handleGet($_GET['id']);
        break;
    case 'POST':
        $response = $controller->handleUpdate($_GET['id'], $_POST);
        break;
    case 'DELETE':
        $response = $controller->handleDelete($_GET['id']);
        break;
    default:
        $response = response('Invalid request method', 400);
        break;
}

echo json_encode($response);
