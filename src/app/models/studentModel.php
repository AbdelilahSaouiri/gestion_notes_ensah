<?php

namespace src\app\models;

use PDO;
use src\database\dbConnection;

include_once __DIR__ . "../../../../vendor/autoload.php";

class studentModel
{
    private $conn;

    public function __construct()
    {
        $con = new dbConnection;
        $this->conn = $con->getConnection();
    }

    public function fetchFiliereForStudentByCin($cin)
    {
        $stmt = $this->conn->prepare("SELECT id_filiere FROM etudiant
                                   WHERE cin=:cin");
        $stmt->bindParam(":cin", $cin);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        return $student;
    }
    public function fetchNameFiliereById($id)
    {
        $stmt = $this->conn->prepare("SELECT nom_filiere FROM filiere 
                                   WHERE id =:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $filiere = $stmt->fetch(PDO::FETCH_ASSOC);
        return $filiere;
    }
    public function fetchNameDepartementByIdFiliere($id)
    {
        $stmt = $this->conn->prepare("SELECT nom_dep FROM departement
                                    JOIN filiere ON departement.id_departement=filiere.id_dep
                                   WHERE filiere.id =:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $departement = $stmt->fetch(PDO::FETCH_ASSOC);
        return $departement;
    }

    public function fetchAllNotes($cin, $id, $ann)
    {
        $stmt = $this->conn->prepare("SELECT *
                                    FROM notes
                                   WHERE cin_etud=:cin 
                                   AND id_module=:id
                                   AND anne_universitaire=:ann");
        $stmt->bindParam(":cin", $cin);
        $stmt->bindParam(":id", $id['id']);
        $stmt->bindParam(":ann", $ann);
        $stmt->execute();
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $notes;
    }

    public function fetchAllModulesByfiliere($filiere, $semestre)
    {
        $stmt = $this->conn->prepare("SELECT nom_modules FROM module
                                   WHERE nom_filiere =:nom_filiere AND semestre=:semestre");
        $stmt->bindParam(":nom_filiere", $filiere);
        $stmt->bindParam(":semestre", $semestre);
        $stmt->execute();
        $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $modules;
    }

    public function fetchArchivesNotes($idFiliere, $idModule, $ann)
    {
        $stmt = $this->conn->prepare("SELECT * FROM notes 
                    WHERE id_filiere=:id_filiere AND id_module=:id_module
                    AND anne_universitaire=:ann_univer");
        $stmt->bindParam(':id_filiere', $idFiliere['id_filiere']);
        $stmt->bindParam(':id_module', $idModule['id']);
        $stmt->bindParam(':ann_univer', $ann);
        $stmt->execute();
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $notes;
    }
    public function fetchNameOfStudentByCin($cin)
    {
        $stmt = $this->conn->prepare("SELECT nom,prenom FROM etudiant 
                    WHERE cin = :cin");
        $stmt->bindParam(":cin", $cin);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        return $student;
    }

    public  function fetchSalleCours($idFiliere)
    {
        $stmt = $this->conn->prepare("SELECT salle_cours from filiere_salle 
        WHERE filiere_id=:id");
        $stmt->bindParam(':id', $idFiliere);
        $stmt->execute();
        $salleCour = $stmt->fetch(PDO::FETCH_ASSOC);
        return $salleCour;
    }


    // public function fetchProfTdTp($module)
    // {
    //     $stmt = $this->conn->prepare("SELECT nom, prenom FROM professeur
    //                               JOIN module ON professeur.cin = module.cin_prof_td_tp
    //                               JOIN prof_departement ON module.cin_prof_td_tp=prof_departement.cin_prof
    //                               WHERE nom_modules = :module");
    //     $stmt->bindParam(':module', $module);
    //     $stmt->execute();
    //     $fullName = $stmt->fetch(PDO::FETCH_ASSOC);
    //     if ($fullName) {
    //         return $fullName['nom'] . ' ' . $fullName['prenom'];
    //     } else {
    //         return "encors";
    //     }
    // }

    // public function fetchNomProCourfForModule($module)
    // {
    //     $stmt = $this->conn->prepare("SELECT nom, prenom FROM professeur
    //                               JOIN module ON professeur.cin = module.cin_prof_cour
    //                               JOIN prof_departement ON module.cin_prof_cour=prof_departement.cin_prof
    //                               WHERE nom_modules = :module");
    //     $stmt->bindParam(':module', $module);
    //     $stmt->execute();
    //     $fullName = $stmt->fetch(PDO::FETCH_ASSOC);
    //     if ($fullName) {
    //         return $fullName['nom'] . ' ' . $fullName['prenom'];
    //     } else {
    //         return "encors";
    //     }
    // }
}
