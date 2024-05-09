<?php

namespace src\app\models;

use PDO;
use PDOException;
use src\database\dbConnection;

include_once __DIR__ . "../../../../vendor/autoload.php";


class chefDepartementModel
{

    private $conn;

    public function __construct()
    {
        $con = new dbConnection;
        $this->conn = $con->getConnection();
    }

    public function fetchAllDepartementFilieres($cin)
    {
        $stmt = $this->conn->prepare("SELECT nom_filiere  FROM filiere JOIN
                                      chef_departement
                                      ON filiere.cin_chef_dep=chef_departement.cin
                                       where cin_chef_dep=:cin");
        $stmt->bindParam(':cin', $cin);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function fetchDepartement($cin)
    {
        $stmt = $this->conn->prepare("SELECT id_departement,nom_dep  FROM departement JOIN chef_departement 
                                      ON departement.cin_chef_dep=chef_departement.cin
                                      where departement.cin_chef_dep=:cin");
        $stmt->bindParam(':cin', $cin);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getAllModules($filiere, $semestre)
    {
        $stmt = $this->conn->prepare("SELECT * FROM module WHERE nom_filiere = :filiere AND semestre = :semestre");
        $stmt->bindParam(':filiere', $filiere, PDO::PARAM_STR);
        $stmt->bindParam(':semestre', $semestre, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function modifierModule($module, $newModule)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("update module set nom_modules=:newmodule where nom_modules=:module ");
            $stmt->bindParam(":newmodule", $newModule);
            $stmt->bindParam(":module", $module);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            return false;
        }
    }

    public function fetchProfsByDepartementId($idDepartement)
    {
        $stmt = $this->conn->prepare("SELECT DISTINCT p.*
                        FROM professeur AS p
                        JOIN prof_departement AS pd ON p.cin = pd.cin_prof
                         WHERE pd.id_departement = :id_departement");
        $stmt->bindParam(':id_departement', $idDepartement);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function authProf($cin)
    {
        $stmt = $this->conn->prepare("SELECT *  FROM professeur where cin=:cin");
        $stmt->bindParam(':cin', $cin);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function storeProf($data)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO professeur(cin, nom, prenom, type_prof,role,email_isntitutionnel)
                                      VALUES(:cin, :nom, :prenom,:type_prof, :role,:email_isntitutionnel)");
            $stmt->bindParam(":cin", $data['cin']);
            $stmt->bindParam(":nom", $data['nom']);
            $stmt->bindParam(":prenom", $data['prenom']);
            $stmt->bindParam(":type_prof", $data['type_prof']);
            $stmt->bindValue(":role", 2);
            $stmt->bindParam(":email_isntitutionnel", $data['email']);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            return false;
        }
    }
    public function storeProfInDepartement($data, $idDepartement)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO prof_departement(cin_prof, id_departement)
                                      VALUES(:cin,:id_departement)");

            $stmt->bindParam(":cin", $data['cin']);
            $stmt->bindParam(":id_departement", $idDepartement);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            return false;
        }
    }

    public function delete($cin)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("DELETE FROM professeur where
                                     cin=:cin");
            $stmt->bindParam(":cin", $cin);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            return false;
        }
    }
    public function findByCin($cin)
    {
        $stmt = $this->conn->prepare("SELECT *  FROM professeur where cin=:cin");
        $stmt->bindParam(':cin', $cin);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function updateProf($data, $cin)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("UPDATE professeur
                                      SET cin=:new_cin, nom=:nom, prenom=:prenom, type_prof=:type_prof, email_isntitutionnel=:email_institutionnel
                                      WHERE cin=:old_cin");
            $stmt->bindParam(':new_cin', $data['cin']);
            $stmt->bindParam(':nom', $data['nom']);
            $stmt->bindParam(':prenom', $data['prenom']);
            $stmt->bindParam(':type_prof', $data['type_prof']);
            $stmt->bindParam(':email_institutionnel', $data['email']);
            $stmt->bindParam(':old_cin', $cin);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            echo $e->getMessage();
            return false;
        }
    }
    // public function storeProfInFiliere($data, $nom_filiere)
    // {
    //     try {
    //         $this->conn->beginTransaction();
    //         $stmt = $this->conn->prepare("UPDATE module
    //                                   SET cin_prof_cour = :cin_prof_cour,
    //                                       cin_prof_td_tp = :cin_prof_td_tp
    //                                   WHERE nom_filiere = :nom_filiere 
    //                                   AND nom_modules = :nom_module");

    //         $stmt->bindParam(':cin_prof_cour', $data['course_prof']);
    //         $stmt->bindParam(':cin_prof_td_tp', $data['tdtp_prof']);
    //         $stmt->bindParam(':nom_filiere', $nom_filiere);
    //         $stmt->bindParam(':nom_module', $data['nom_module']);
    //         $stmt->execute();
    //         $this->conn->commit();
    //         return true;
    //     } catch (PDOException $e) {
    //         $this->conn->rollback();
    //         echo $e->getMessage();
    //         return false;
    //     }
    // }

    public function fetchIdFiliereByName($filiere)
    {
        $stmt = $this->conn->prepare("SELECT id  FROM filiere WHERE nom_filiere=:nom_filiere");
        $stmt->bindParam(':nom_filiere', $filiere);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function storeProfInFilireCovenable($data, $idDepartement, $id)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO  prof_departement(cin_prof,id_departement,id_filieres)
                                      VALUES(:cin_prof,:id_departement,:id_filieres)");
            $stmt->bindParam(':cin_prof', $data['cin']);
            $stmt->bindParam(':id_departement', $idDepartement);
            //$stmt->bindParam(':id_filieres', $id);
            $stmt->bindValue(":id_filieres", $id, PDO::PARAM_STR);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            echo $e->getMessage();
            return false;
        }
    }
}
