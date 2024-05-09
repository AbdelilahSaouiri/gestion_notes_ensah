<?php

namespace src\app\models;

use src\database\dbConnection;
use PDO;
use PDOException;

include_once __DIR__ . "../../../../vendor/autoload.php";

class RestModel
{

    private $conn;

    public function __construct()
    {
        $con = new dbConnection;
        $this->conn = $con->getConnection();
    }

    public function fetchCinByfullName($firstName, $lastName)
    {
        $stmt = $this->conn->prepare("SELECT cin FROM professeur 
                                WHERE professeur.nom = :nom AND professeur.prenom = :prenom");
        $stmt->bindParam(":nom", $firstName);
        $stmt->bindParam(":prenom", $lastName);
        $stmt->execute();
        $cin = $stmt->fetch(PDO::FETCH_ASSOC);
        return $cin;
    }

    public function updateModuleProfessors($moduleId, $courseProf, $tdtpProf)
    {
        if (!empty($moduleId) && !empty($courseProf) && !empty($tdtpProf)) {
            try {
                $this->conn->beginTransaction();
                $sql = "UPDATE module SET cin_prof_cour = :courseProf, cin_prof_td_tp = :tdtpProf WHERE nom_modules = :moduleId";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":courseProf", $courseProf);
                $stmt->bindParam(":tdtpProf", $tdtpProf);
                $stmt->bindParam(":moduleId", $moduleId);
                $stmt->execute();
                $this->conn->commit();
                return true;
            } catch (PDOException $e) {
                $this->conn->rollback();
                echo $e->getMessage();
                return false;
            }
        } else {
            return false;
        }
    }
}
