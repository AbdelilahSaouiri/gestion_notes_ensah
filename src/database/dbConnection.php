<?php

namespace src\database;

use PDO;
use PDOException;

class dbConnection
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "gestion_notes_ensah";

    public function  getConnection()
    {
        try {
            $db = new PDO("mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password);
            $db->exec("set names utf8");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {

            echo "erreurs lors de la connection via db" . $e->getMessage();
        }
    }
}
