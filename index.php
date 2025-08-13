<?php
// IMPORTAÇÃO DE ARQUIVOS
require_once __DIR__ . '/vendor/autoload.php';

use Controller\VeiculoController;
$VeiculoController = new VeiculoController();

// ARMAZENA O MÉTODO HTTP
$method = $_SERVER['REQUEST_METHOD'];

// VERIFICAR O MÉTODO E EXECUTAR UMA AÇÃO
switch ($method) {
    case 'GET':
        $ID = $_GET['ID'] ?? null;
        $modelo = $_GET['modelo'] ?? null;

        if ($ID) {
            $VeiculoController->getVeiculoById($ID);
        } 
        else if ($modelo) {
            $VeiculoController->getVeiculoByModelo($modelo);
        } else {
            $VeiculoController->getVeiculos();
        }
        break;
    case 'POST':
        $VeiculoController->createVeiculos();
        break;

    case 'PUT':
        $VeiculoController->updateVeiculo();
        break;

    case 'DELETE':
        $VeiculoController->deleteVeiculo();
        break;
    default:
        // FORMATA TEXTO EM JSON
        echo json_encode(["message" => "Method not allowed"]);
        break;
}

