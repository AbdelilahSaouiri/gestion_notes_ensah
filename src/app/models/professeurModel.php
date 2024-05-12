<?php

namespace src\app\models;

use DateTime;
use PDO;
use PDOException;
use src\database\dbConnection;

include_once __DIR__ . "../../../../vendor/autoload.php";

class professeurModel
{
    private $conn;

    public function __construct()
    {
        $con = new dbConnection;
        $this->conn = $con->getConnection();
    }

    public function getfilieresBycin($cin)
    {
        $stmt = $this->conn->prepare("SELECT nom_filiere FROM filiere
                                      JOIN prof_departement ON filiere.id=prof_departement.id_filieres
                                   WHERE prof_departement.cin_prof =:cin");
        $stmt->bindParam(":cin", $cin);
        $stmt->execute();
        $departement = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $departement;
    }
    public function fetchDepartement($cin)
    {
        $stmt = $this->conn->prepare("SELECT * FROM departement JOIN prof_departement 
                                    ON departement.id_departement=prof_departement.id_departement
                                   WHERE prof_departement.cin_prof =:cin");
        $stmt->bindParam(":cin", $cin);
        $stmt->execute();
        $departement = $stmt->fetch(PDO::FETCH_ASSOC);
        return $departement;
    }

    public function fetchIdFiliere($nomFiliere)
    {
        $stmt = $this->conn->prepare("SELECT id FROM filiere 
                                   WHERE nom_filiere =:nom_filiere");
        $stmt->bindParam(":nom_filiere", $nomFiliere);
        $stmt->execute();
        $idFiliere = $stmt->fetch(PDO::FETCH_ASSOC);
        return $idFiliere;
    }

    public function fetchStudentByFiliere($id_filiere, $ann)
    {
        $stmt = $this->conn->prepare("SELECT * FROM etudiant 
                                   WHERE id_filiere =:id_filiere
                                   AND anne_universitaire=:ann");
        $stmt->bindParam(":id_filiere", $id_filiere);
        $stmt->bindParam(":ann", $ann);
        $stmt->execute();
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $students;
    }

    public function auth($idModule, $student)
    {
        $stmt = $this->conn->prepare("SELECT * FROM notes 
                                WHERE id_module = :id_module AND cin_etud = :cin_etud");
        $stmt->bindParam(":id_module", $idModule);
        $stmt->bindParam(":cin_etud", $student['cin']);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function storeNotes($data, $student)
    {
        try {
            $now = new DateTime();
            $mois_annee = $now->format('m-Y');
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO notes(note_ds, note_exam, note_tp_projet, id_module, cin_etud,id_filiere,anne_universitaire)
                                  VALUES(:note_ds, :note_exam, :note_tp_projet, :id_module, :cin,:id_filiere,:anne_universitaire)");
            $stmt->bindParam(":note_ds", $data['ds'][$student['cin']]);
            $stmt->bindParam(":note_exam", $data['exam'][$student['cin']]);
            $stmt->bindParam(":note_tp_projet", $data['projet'][$student['cin']]);
            $stmt->bindParam(":id_module", $data['id_module']);
            $stmt->bindParam(":cin", $data['cin']);
            $stmt->bindParam(":id_filiere", $data['id_filiere']);
            $stmt->bindParam(":anne_universitaire", $mois_annee);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            return false;
        }
    }

    public function fetchIdModuleByName($module)
    {
        $stmt = $this->conn->prepare("SELECT id FROM module WHERE nom_modules=:module");
        $stmt->bindParam(':module', $module);
        $stmt->execute();
        $idModule = $stmt->fetch(PDO::FETCH_ASSOC);
        return $idModule;
    }

    public function fetchAllNotes($idFiliere, $idModule, $ann)
    {
        $stmt = $this->conn->prepare("SELECT * FROM notes 
                    WHERE id_filiere=:id_filiere AND id_module=:id_module
                    AND anne_universitaire=:ann_univer");
        $stmt->bindParam(':id_filiere', $idFiliere['id']);
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

    public function fetchSemestreByModuleId($module)
    {
        $stmt = $this->conn->prepare("SELECT semestre FROM module WHERE nom_modules=:module");
        $stmt->bindParam(':module', $module);
        $stmt->execute();
        $semestre = $stmt->fetch(PDO::FETCH_ASSOC);
        return $semestre;
    }

    public function updateNoteStudent($data)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("UPDATE notes SET
            note_ds=:ds,
            note_exam=:exam,
            note_tp_projet=:tp
            WHERE cin_etud=:cin");
            $stmt->bindParam(":ds", $data['note_ds']);
            $stmt->bindParam(":exam", $data['note_exam']);
            $stmt->bindParam(":tp", $data['note_tp']);
            $stmt->bindParam(":cin", $data['cin']);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            return false;
        }
    }

    public function fetchAnneUniversitaire()
    {
        $stmt = $this->conn->prepare("SELECT DISTINCT anne_universitaire FROM notes ");
        $stmt->execute();
        $anne_universiatires = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $anne_universiatires;
    }
}
