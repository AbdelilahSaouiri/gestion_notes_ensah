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

    public function authEtud($data)
    {
        $stmt = $this->conn->prepare("select * from etudiant where
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
            $stmt = $this->conn->prepare("INSERT INTO professeur(cin, nom, prenom,type_prof, role,email_isntitutionnel)
                                    VALUES(:cin, :nom, :prenom,:type_prof, :role,:email)");
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

    public function storeProfinFiliere($data, $id)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO affectation_prof_filiere (id_filiere,cin_prof) VALUES 
                        (:id_filiere, :cin_prof)");
            $stmt->bindValue(":id_filiere", $id, PDO::PARAM_STR);
            $stmt->bindValue(":cin_prof", $data['cin'], PDO::PARAM_STR);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            echo $e->getMessage();
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

    public function getIdFiliereByName($data)
    {
        $stmt = $this->conn->prepare("SELECT id FROM filiere  WHERE nom_filiere=:nom_filiere");
        $stmt->bindParam(':nom_filiere', $data['filiere'], PDO::PARAM_STR);
        $stmt->execute();
        $idFiliere = $stmt->fetch(PDO::FETCH_ASSOC);
        return $idFiliere;
    }

    public function getNameByIdFiliere($data)
    {
        $stmt = $this->conn->prepare("SELECT nom_filiere FROM filiere  WHERE id=:id");
        $stmt->bindParam(':id', $data, PDO::PARAM_STR);
        $stmt->execute();
        $idFiliere = $stmt->fetch(PDO::FETCH_ASSOC);
        return $idFiliere;
    }

    /*
  students
  */
    public function getAllStudents()
    {
        $stmt = $this->conn->prepare("select * from etudiant");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function storeStudent($data, $id)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO etudiant(nom,prenom,cin,cne,role,email_institutionnel,id_filiere)
                                    VALUES(:nom,:prenom,:cin,:cne,:role,:email,:id_filiere)");
            $stmt->bindParam(":nom", $data['nom']);
            $stmt->bindParam(":prenom", $data['prenom']);
            $stmt->bindParam(":cin", $data['cin']);
            $stmt->bindParam(":cne", $data['cne']);
            $stmt->bindValue(":role", 1);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":id_filiere", $id['id']);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            return false;
        }
    }

    public function findEtudByCin($cin)
    {
        $data = [];
        $stmt = $this->conn->prepare("SELECT *  FROM etudiant where cin=:cin");
        $stmt->bindParam(':cin', $cin);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function modifierStudent($data, $cin)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("UPDATE etudiant
                                      SET cin=:new_cin, nom=:nom, prenom=:prenom, cne=:new_cne,email_institutionnel=:email_institutionnel
                                      WHERE cin=:old_cin");
            $stmt->bindParam(':new_cin', $data['cin']);
            $stmt->bindParam(':nom', $data['nom']);
            $stmt->bindParam(':prenom', $data['prenom']);
            $stmt->bindParam(':new_cne', $data['cne']);
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

    public function deleteEtud($cin)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("DELETE FROM etudiant WHERE cin=:cin");
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

    /*teachers */

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

    /*coordinateur
    */
    public function getAllCoordinateurs()
    {
        $stmt = $this->conn->prepare("select * from coordinateur");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function find_Cord_By_Cin($cin)
    {
        $stmt = $this->conn->prepare("select * from coordinateur where
                                   cin=:cin ");
        $stmt->bindParam(":cin", $cin);
        $stmt->execute();
        $cord = $stmt->fetch(PDO::FETCH_ASSOC);
        return $cord;
    }

    public function storeCord($data)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO coordinateur(nom, prenom, email_institutionnel, cin, filiere, departement, role)
                                      VALUES(:nom, :prenom, :email, :cin, :filiere, :departement, :role)");
            $stmt->bindParam(":nom", $data['nom']);
            $stmt->bindParam(":prenom", $data['prenom']);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":cin", $data['cin']);
            $stmt->bindParam(":filiere", $data['filiere']);
            $stmt->bindParam(":departement", $data['departement']);
            $stmt->bindValue(":role", 3);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            return false;
        }
    }

    public function deleteCord($cin)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("DELETE FROM coordinateur WHERE cin=:cin");
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

    public function updateCoordinateur($data, $cin)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("UPDATE coordinateur
                                      SET cin=:new_cin, nom=:nom, prenom=:prenom, email_institutionnel=:email_institutionnel, filiere=:filiere,departement=:departement
                                      WHERE cin=:old_cin");
            $stmt->bindParam(':new_cin', $data['cin']);
            $stmt->bindParam(':nom', $data['nom']);
            $stmt->bindParam(':prenom', $data['prenom']);
            $stmt->bindParam(':filiere', $data['filiere']);
            $stmt->bindParam(':departement', $data['departement']);
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

    /*chef_departements
   */

    public function getAllChefDepartements()
    {
        $stmt = $this->conn->prepare("select * from chef_departement");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function getDepartementName($cin)
    {
        $stmt = $this->conn->prepare("select nom_dep from departement 
                    join chef_departement on departement.cin_chef_dep=chef_departement.cin
                    where chef_departement.cin=:cin");
        $stmt->bindParam(':cin', $cin);
        $stmt->execute();
        $departement = $stmt->fetch(PDO::FETCH_ASSOC);
        return $departement;
    }

    public function auth_Chef_departement($cin)
    {
        $stmt = $this->conn->prepare("select * from chef_departement where
                                   cin=:cin ");
        $stmt->bindParam(":cin", $cin);
        $stmt->execute();
        $chef_dep = $stmt->fetch(PDO::FETCH_ASSOC);
        return $chef_dep;
    }
    public function store_Chef_Departement($data)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO chef_departement(nom, prenom, email_institutionnel, cin,role)
                                      VALUES(:nom, :prenom, :email, :cin, :role)");
            $stmt->bindParam(":nom", $data['nom']);
            $stmt->bindParam(":prenom", $data['prenom']);
            $stmt->bindParam(":email", $data['email']);
            $stmt->bindParam(":cin", $data['cin']);
            $stmt->bindValue(":role", 4);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            return false;
        }
    }

    public function store_cin_chef_departement_in_departement($departement, $cin)
    {
        $stmt = $this->conn->prepare("INSERT INTO departement (nom_dep, cin_prof, cin_cord, cin_chef_dep)
                                   VALUES (:nom_dep,'', '', :cin_chef_dep)");

        $stmt->bindParam(":nom_dep", $departement);
        $stmt->bindParam(":cin_chef_dep", $cin);
        $stmt->execute();
    }


    public function delete_Chef_Departement($cin)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("DELETE FROM chef_departement WHERE cin=:cin");
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

    public function deleteForeignkeyfromDepartement($cin)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("DELETE FROM departement WHERE cin_chef_dep=:cin");
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
    public function find_chef_departement_by_cin($cin)
    {
        $stmt = $this->conn->prepare("select * from chef_departement where
                                   cin=:cin ");
        $stmt->bindParam(":cin", $cin);
        $stmt->execute();
        $cord = $stmt->fetch(PDO::FETCH_ASSOC);
        return $cord;
    }

    public function updateCinIndepartement($data, $cin)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("UPDATE departement
                                  SET  nom_dep=:nom_dep , cin_chef_dep=:cin_chef_dep
                                  WHERE departement.cin_chef_dep=:old_cin");
            $stmt->bindParam(':nom_dep', $data['departement']);
            $stmt->bindParam(':cin_chef_dep', $data['cin']);
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


    public function update_Chef_Departement($data, $cin)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("UPDATE chef_departement
                                      SET cin=:new_cin, nom=:nom, prenom=:prenom, email_institutionnel=:email_institutionnel
                                      WHERE cin=:old_cin");
            $stmt->bindParam(':new_cin', $data['cin']);
            $stmt->bindParam(':nom', $data['nom']);
            $stmt->bindParam(':prenom', $data['prenom']);
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


































    //administrateur
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
