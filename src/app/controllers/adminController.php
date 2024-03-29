<?php

namespace  src\app\controllers;

include_once __DIR__ . "../../../../vendor/autoload.php";

use src\app\models\adminModel;
use Stringable;

class adminController
{
    private $model;

    public function __construct()
    {
        $this->model = new adminModel();
    }

    public function registerProf($data)
    {
        $existingUser = $this->model->auth($data);
        if ($existingUser) {
            $_SESSION['error'] = "Cet utilisateur existe déjà.";
        } else {
            $inserted = $this->model->storeProf($data);
            if ($inserted == true) {
                $_SESSION['success'] = "Le professeur a été enregistré avec succès.";
            }
        }
    }

    public function findProfByCin($cin)
    {
        $prof = $this->model->findByCin($cin);
        if ($prof) {
            $_SESSION['infos'] = $prof;
            return true;
        } else {
            return false;
        }
    }
    public function update($data, $cin)
    {
        if ($this->findProfByCin($cin) == true) {
            $updated = $this->model->updateProf($data, $cin);
            if ($updated == true) {
                $_SESSION['success'] = "updated successufly";
            } else {
                $_SESSION['erreur'] = "cet utlilisateur n'existe pas";
            }
        }
    }


    public function storeProf_Departement($data, $nbrFiliers)
    {
        $existingUser = $this->model->authProfDepartement($data['cin']);
        if ($existingUser) {
            $_SESSION['error'] = "Cet utilisateur existe déjà.";
        } else {

            $cord = [];
            $chef_dep = [];
            $chef_dep = $this->model->getChefDepartement($data['departement']);
            for ($i = 0; $i < $nbrFiliers; $i++) {
                $coordinateurs = $this->model->getCoordianteur($data['filiere'][$i]);
                if ($coordinateurs) {
                    foreach ($coordinateurs as $coordinateur) {
                        $cord[] = $coordinateur;
                    }
                }
            }
            if (!empty($cord)) {
                for ($i = 0; $i < $nbrFiliers; $i++) {
                    $donnees['nom_dep'] = $data['departement'];
                    $donnees['cin_prof'] =  $data['cin'];
                    $donnees['cin_cord'] = $cord[$i]['cin'];
                    $donnees['cin_chef_dep'] = $chef_dep['cin'];
                    $this->model->storeProfinDepartement($donnees);
                }
            }
        }
    }


    public function fetchAllStudents()
    {

        $students = $this->model->getAllStudents();
        $_SESSION['students'] = $students;
    }
    public function fetchAllteachers()
    {
        $profs = $this->model->getAllteachers();
        $_SESSION['profs'] = $profs;
    }

    public function fetchDepartementforTeach()
    {
        $departements = $this->model->getDepartementforEachTeachers();
        $_SESSION['departement'] = $departements;
        // var_dump($_SESSION['departement']);
        // exit;
    }
    public function fetchAllCoordinateurs()
    {
        $coordinateurs = $this->model->getAllcoordinateurs();
        $_SESSION['coordinateurs'] = $coordinateurs;
    }
    public function fetchAllchefDepartement()
    {

        $chef_departements = $this->model->getAllStudents();
        $_SESSION['chef_departements'] = $chef_departements;
    }
}

// $user = new adminController;

// var_dump($user->storeProf_Departement($data));
