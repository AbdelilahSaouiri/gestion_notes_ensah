<?php

namespace src\app\models;

use src\database\dbConnection;
use PDO;

include_once __DIR__ . "../../../../vendor/autoload.php";

class userModel
{

    private $conn;

    public function __construct()
    {
        $con = new dbConnection;
        $this->conn = $con->getConnection();
    }

    public function getAllusers()
    {
        $stmt = $this->conn->prepare("select * from utilisateur");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function auth($data)
    {
        $stmt = $this->conn->prepare("SELECT * FROM utilisateur WHERE email_institutionnel=:email AND password=:password");
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['pwd']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function getInformationsByRole($role, $cin)
    {
        if ($role == 0) {
            $stmt = $this->conn->prepare("SELECT * FROM admin 
                       JOIN utilisateur ON admin.cin = utilisateur.cin 
                       WHERE admin.cin = :cin");

            $stmt->bindParam(":cin", $cin);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }

        if ($role == 1) {
            $stmt = $this->conn->prepare("SELECT * FROM etudiant 
                       JOIN utilisateur ON etudiant.cin = utilisateur.cin 
                       WHERE etudiant.cin = :cin");

            $stmt->bindParam(":cin", $cin);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
        if ($role == 2) {
            $stmt = $this->conn->prepare("SELECT * FROM professeur 
                       JOIN utilisateur ON professeur.cin = utilisateur.cin 
                       WHERE professeur.cin = :cin");

            $stmt->bindParam(":cin", $cin);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
        if ($role == 3) {
            $stmt = $this->conn->prepare("SELECT * FROM coordinateur 
                       JOIN utilisateur ON coordinateur.cin = utilisateur.cin 
                       WHERE coordinateur.cin = :cin");

            $stmt->bindParam(":cin", $cin);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
        if ($role == 4) {
            $stmt = $this->conn->prepare("SELECT * FROM chef_departement 
                       JOIN utilisateur ON chef_departement.cin = utilisateur.cin 
                       WHERE chef_departement.cin = :cin");

            $stmt->bindParam(":cin", $cin);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
    }
}
