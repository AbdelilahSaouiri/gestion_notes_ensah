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

    public function fetchDepartement($cin)
    {
        $stmt = $this->conn->prepare("SELECT * FROM departement JOIN coordinateur ON departement.cin_cord=coordinateur.cin
                                   WHERE coordinateur.cin =:cin");
        $stmt->bindParam(":cin", $cin);
        $stmt->execute();
        $departement = $stmt->fetch(PDO::FETCH_ASSOC);
        return $departement;
    }
    public function getFilieresForEachCoordinateur($cin)
    {
        $stmt = $this->conn->prepare("SELECT nom_filiere FROM filiere JOIN coordinateur ON filiere.cin_cord=coordinateur.cin
                                   WHERE coordinateur.cin =:cin");
        $stmt->bindParam(":cin", $cin);
        $stmt->execute();
        $filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $filieres;
    }

    public function fetchModules_filiere($filiere, $semestre)
    {
        $stmt = $this->conn->prepare("SELECT nom_modules FROM module 
                                   WHERE nom_filiere =:nom_filiere
                                   AND semestre=:semestre");
        $stmt->bindParam(":nom_filiere", $filiere);
        $stmt->bindParam(":semestre", $semestre);
        $stmt->execute();
        $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $modules;
    }
}
