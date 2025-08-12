<?php

namespace Model;

use PDO;
use Model\Connection;

class Veiculo
{
    private $conn;

    public $id;
    public $modelo;
    public $status;
    public $ano;
    public $placa;
    public $ult_rev;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    // Método para obter todos os veículos
    public function getVeiculos()
    {
        $sql = "SELECT * FROM veiculos";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para criar um novo veículo
    public function createVeiculos()
    {
        $sql = "INSERT INTO veiculos (modelo, status, ano, placa, ult_rev) VALUES (:modelo, :status, :ano, :placa, :ult_rev)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":modelo", $this->modelo, PDO::PARAM_STR);
        $stmt->bindParam(":status", $this->status, PDO::PARAM_STR);
        $stmt->bindParam(":ano", $this->ano, PDO::PARAM_STR);
        $stmt->bindParam(":placa", $this->placa, PDO::PARAM_STR);
        $stmt->bindParam(":ult_rev", $this->ult_rev, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function updateVeiculo()
    {
        $sql = "UPDATE veiculos SET modelo = :modelo, status = :status, ano = :ano, placa = :placa, ult_rev = :ult_rev WHERE ID = :ID";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":ID", $this->ID, PDO::PARAM_INT);
        $stmt->bindParam(":modelo", $this->modelo, PDO::PARAM_STR);
        $stmt->bindParam(":status", $this->status, PDO::PARAM_STR);
        $stmt->bindParam(":ano", $this->ano, PDO::PARAM_STR);
        $stmt->bindParam(":placa", $this->placa, PDO::PARAM_STR);
        $stmt->bindParam(":ult_rev", $this->ult_rev, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function deleteVeiculo()
    {
        $sql = "DELETE FROM veiculos WHERE ID = :ID";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":ID", $this->ID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}