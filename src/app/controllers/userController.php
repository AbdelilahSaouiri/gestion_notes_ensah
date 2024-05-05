<?php

namespace  src\app\controllers;

include_once __DIR__ . "../../../../vendor/autoload.php";

use src\app\models\userModel;



class userController
{
    private $model;

    public function __construct()
    {
        $this->model = new userModel();
    }



    public function login($email, $pwd)
    {
        session_start();

        $data = [];
        $data['email'] = $email;
        $data['pwd'] = $pwd;
        $user = $this->model->auth($data);

        if ($user) {
            $role = $user['role'];
            $cin = $user['cin'];
            $utilisateur = $this->model->getInformationsByRole($role, $cin);
            // echo $role;
            if ($role == 0) {
                $_SESSION['nom'] = $utilisateur['nom'];
                header("Location: http://localhost/gestion_notes_ensah/src/public/views/static/administration/home.admin.php");
                exit;
            }
            if ($role == 1) {
                $_SESSION['nom'] = $utilisateur['nom'];
                $_SESSION['prenom'] =  $utilisateur['prenom'];
                header("Location: http://localhost/gestion_notes_ensah/src/public/views/static/etudiant/home.etudiant.php");
                exit;
            }
            if ($role == 2) {

                $_SESSION['nom'] = $utilisateur['nom'];
                $_SESSION['prenom'] =  $utilisateur['prenom'];
                header("Location: http://localhost/gestion_notes_ensah/src/public/views/static/professeur/home.prof.php");
                exit;
            }
            if ($role == 3) {
                //add verification si le prof le meme coordinateur

                $_SESSION['nom'] = $utilisateur['nom'];
                $_SESSION['prenom'] =  $utilisateur['prenom'];
                $_SESSION['cin_cord'] =  $utilisateur['cin'];
                header("Location: http://localhost/gestion_notes_ensah/src/public/views/static/coordinateur/home.cordinateur.php");
                exit;
            }
            if ($role == 4) {
                $_SESSION['nom'] = $utilisateur['nom'];
                $_SESSION['prenom'] =  $utilisateur['prenom'];
                $_SESSION['chef_cin'] = $utilisateur['cin'];
                header("Location: http://localhost/gestion_notes_ensah/src/public/views/static/chef_departement/home.chef_dep.php");
                exit;
            } else {

                header("Location: ../../public/views/static/login.php?error=1");
                exit;
            }
        }
    }
    public function index()
    {
        $users = $this->model->getAllusers();

        echo json_encode($users);
    }
}
