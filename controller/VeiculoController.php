<?php

namespace Controller;

use Model\Veiculo;

class VeiculoController
{
    // Função para pegar todos os veículos
    public function getVeiculos()
    {
        $veiculo = new Veiculo();
        $veiculos = $veiculo->getVeiculos();


        if ($veiculos) {
            // Envia a resposta JSON
            header('Content-Type: application/json');
            echo json_encode($veiculos);
        } else {
            echo json_encode(["message" => "No veiculos found"]);
        }
    }

    public function getVeiculoById()
    {
       $ID = $_GET['ID'] ?? null;

        if ($ID) {
            $veiculo = new Veiculo();
            $veiculo->ID = $ID;

            $veiculoData = $veiculo->getVeiculoById($ID);
            if ($veiculoData) {
                echo json_encode($veiculoData);
            } else {
                echo json_encode(["message" => "Veiculo not found"]);
            }
        } else {
            echo json_encode(["message" => "Invalid ID"]);
        }
    }

    public function getVeiculoByModelo()
    {
        $modelo = $_GET['modelo'] ?? null;

        if ($modelo) {
            $veiculo = new Veiculo();
            $veiculo->modelo = $modelo;

            $veiculoData = $veiculo->getVeiculoByModelo($modelo);
            if ($veiculoData) {
                echo json_encode($veiculoData);
            } else {
                echo json_encode(["message" => "Veiculo not found"]);
            }
        } else {
            echo json_encode(["message" => "Invalid modelo"]);
        }
    }

    
           

    // Função para criar um veículo
    public function createVeiculos()
    {
        // Obtém os dados da requisição
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->modelo) && isset($data->status) && isset($data->ano) && isset($data->placa) && isset($data->ult_rev)) {
            $veiculo = new Veiculo();
            $veiculo->modelo = $data->modelo;
            $veiculo->status = $data->status;
            $veiculo->ano = $data->ano;
            $veiculo->placa = $data->placa;
            $veiculo->ult_rev = $data->ult_rev;

            if ($veiculo->createVeiculos()) {
                echo json_encode(["message" => "Veiculo created successfully"]);
            } else {
                echo json_encode(["message" => "Failed to create veiculo"]);
            }
        } else {
            echo json_encode(["message" => "Invalid input"]);
        }
    }

    public function updateVeiculo()
    {
        
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->ID) && isset($data->modelo) && isset($data->status) && isset($data->ano) && isset($data->placa) && isset($data->ult_rev)) {
            $veiculo = new Veiculo();
            $veiculo->ID = $data->ID;
            $veiculo->modelo = $data->modelo;
            $veiculo->status = $data->status;
            $veiculo->ano = $data->ano;
            $veiculo->placa = $data->placa;
            $veiculo->ult_rev = $data->ult_rev;

            if ($veiculo->updateVeiculo()) {
                echo json_encode(["message" => "Veiculo updated successfully"]);
            } else {
                echo json_encode(["message" => "Failed to update veiculo"]);
            }
        } else {
            echo json_encode(["message" => "Invalid input"]);
        }
    }

    public function deleteVeiculo()
    {
       $ID = $_GET['ID'] ?? null;

        if ($ID) {
            $veiculo = new Veiculo();
            $veiculo->ID = $ID;

            if ($veiculo->deleteVeiculo()) {
                echo json_encode(["message" => "Veiculo deleted successfully"]);
            } else {
                echo json_encode(["message" => "Failed to delete veiculo"]);
            }
        } else {
            echo json_encode(["message" => "Invalid ID"]);
        }
    }
}