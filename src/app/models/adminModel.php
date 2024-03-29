<?php

namespace src\app\models;

use src\database\dbConnection;
use PDO;
use PDOException;


include_once __DIR__ . "../../../../vendor/autoload.php";

class adminModel
{

    private $conn;

    public function __construct()
    {
        $con = new dbConnection;
        $this->conn = $con->getConnection();
    }


    public function auth($data)
    {
        $stmt = $this->conn->prepare("select * from professeur where
                                   cin=:cin ");
        $stmt->bindParam(":cin", $data['cin']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    public function authProfDepartement($cin)
    {

        $stmt = $this->conn->prepare("select * from departement where
                                   cin_prof=:cin_prof ");

        $stmt->bindParam(":cin_prof", $cin);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function storeProf($data)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO professeur(cin, nom, prenom,type_prof, role, email_isntitutionnel)
                                    VALUES(:cin, :nom, :prenom,:type_prof, :role, :email)");
            $stmt->bindParam(":cin", $data['cin']);
            $stmt->bindParam(":nom", $data['nom']);
            $stmt->bindParam(":prenom", $data['prenom']);
            $stmt->bindParam(":type_prof", $data['type_prof']);
            $stmt->bindValue(":role", 2);
            $stmt->bindParam(":email", $data['email']);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            return false;
        }
    }

    public function storeProfinDepartement($data)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO departement(nom_dep, cin_prof, cin_cord, cin_chef_dep)
                                      VALUES(:nom_dep, :cin_prof, :cin_cord, :cin_chef_dep)");

            $stmt->bindValue(":nom_dep", $data['nom_dep'], PDO::PARAM_STR);
            $stmt->bindValue(":cin_prof", $data['cin_prof'], PDO::PARAM_STR);
            $stmt->bindValue(":cin_cord", $data['cin_cord'], PDO::PARAM_STR);
            $stmt->bindValue(":cin_chef_dep", $data['cin_chef_dep'], PDO::PARAM_STR);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            echo $e->getMessage();
            return false;
        }
    }

    public function findByCin($cin)
    {
        $data = [];
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

    public function delete($cin)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("DELETE FROM professeur WHERE cin=:cin");
            $stmt->bindParam(':cin', $cin);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            echo $e->getMessage();
            return false;
        }
    }

    public function getCoordianteur($filiere)
    {
        $stmt = $this->conn->prepare("SELECT *  FROM coordinateur 
                                    JOIN filiere ON filiere.cin_cord = coordinateur.cin 
                                    WHERE filiere.nom_filiere = :filiere");
        $stmt->bindValue(":filiere", $filiere, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Vérifiez si des résultats sont renvoyés avant d'essayer d'y accéder
        if ($data) {
            return $data;
        } else {
            return false; // Ou une autre valeur appropriée pour indiquer l'absence de résultats
        }
    }



    public function getChefDepartement($departement)
    {

        $stmt = $this->conn->prepare("SELECT * FROM chef_departement 
                                    JOIN departement ON chef_departement.cin = departement.cin_chef_dep 
                                    WHERE departement.nom_dep = :departement");
        $stmt->bindParam(":departement", $departement, PDO::PARAM_STR);
        $stmt->execute();
        $chef_departement = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($chef_departement) {
            return $chef_departement;
        } else {
            return false;
        }
    }


    public function getAllStudents()
    {
        $stmt = $this->conn->prepare("select * from etudiant");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    public function getAllteachers()
    {
        $stmt = $this->conn->prepare("select * from professeur");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function getDepartementforEachTeachers()
    {
        $stmt = $this->conn->prepare("select nom_dep  from departement join professeur on 
                                     departement.cin_prof=professeur.cin ");
        $stmt->execute();
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        return $users;
    }

    public function getAllCoordinateurs()
    {
        $stmt = $this->conn->prepare("select * from coordinateur");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function getAllAdministrateurs()
    {
        $stmt = $this->conn->prepare("select * from admin");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
}


// $user = new adminModel;

// var_dump($user->getChefDepartement("informatique et mathematique"));
