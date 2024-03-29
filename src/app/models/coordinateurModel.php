<?php

namespace src\app\models;

use PDO;
use src\database\dbConnection;

include_once __DIR__ . "../../../../vendor/autoload.php";

class coordinateurModel
{
    private $conn;

    public function __construct()
    {
        $con = new dbConnection;
        $this->conn = $con->getConnection();
    }


    public function getFilieresForEachCoordinateur($cin)
    {
        $stmt = $this->conn->prepare("SELECT nom_filiere FROM filiere JOIN coordinateur ON filiere.cin_cord = coordinateur.cin WHERE coordinateur.cin = :cin");
        $stmt->bindParam(":cin", $cin);
        $stmt->execute();
        $filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $filieres;
    }
}
