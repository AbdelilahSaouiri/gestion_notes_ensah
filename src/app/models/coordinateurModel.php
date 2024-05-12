<?php

namespace src\app\models;

use PDO;
use PDOException;
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
        $stmt = $this->conn->prepare("SELECT id,nom_filiere FROM filiere JOIN coordinateur ON filiere.cin_cord=coordinateur.cin
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

    public function fetchProfsForFiliere($id_filiere)
    {
        $stmt = $this->conn->prepare("SELECT filiere.nom_filiere,professeur.nom,professeur.prenom,professeur.cin FROM professeur
                                    JOIN prof_departement ON professeur.cin=prof_departement.cin_prof
                                    JOIN filiere ON filiere.id=prof_departement.id_filieres
                                   WHERE filiere.id=:id_filiere");
        $stmt->bindParam(":id_filiere", $id_filiere);
        $stmt->execute();
        $profs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profs;
    }

    public function fetchModulesForProf($cin_prof)
    {
        $stmt = $this->conn->prepare("SELECT * FROM module 
                                   WHERE cin_prof_cour =:cin_prof_cour
                                   OR cin_prof_td_tp=:cin_prof_td_tp");
        $stmt->bindParam(":cin_prof_cour", $cin_prof);
        $stmt->bindParam(":cin_prof_td_tp", $cin_prof);
        $stmt->execute();
        $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $modules;
    }

    public function stockerNewPromo($data, $id, $ann)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO etudiant(nom,prenom,cin,cne,role,email_institutionnel,id_filiere,anne_universitaire)
         VALUES  (:nom, :prenom,:cin,:cne,:role,:email_institutionnel,:id_filiere,:anne_universitaire)"); // Correction de la requête SQL
            $stmt->bindParam(":nom", $data['nom']);
            $stmt->bindParam(":prenom", $data['prenom']);
            $stmt->bindParam(":cin", $data['cin']);
            $stmt->bindParam(":cne", $data['cne']);
            $role = 1;
            $stmt->bindParam(":role", $role);
            $stmt->bindParam(":email_institutionnel", $data['email_inst']);
            $stmt->bindParam(":id_filiere", $id['id']);
            $stmt->bindParam(":anne_universitaire", $ann);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            echo $e->getMessage();
            return false;
        }
    }

    public function auth($data)
    {
        $stmt = $this->conn->prepare("SELECT * FROM etudiant 
                             WHERE cin = :cin");
        $stmt->bindParam(":cin", $data['cin']);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        return $student ? true : false;
    }
}
