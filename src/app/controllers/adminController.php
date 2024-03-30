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
    /*
     CRUD app pour les professeurs 
      */

    public function fetchAllteachers()
    {
        $profs = $this->model->getAllteachers();
        $_SESSION['profs'] = $profs;
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

    public function registerProf_Filiere($data, $nbrFiliers)
    {

        $id_filieres = [];
        for ($i = 0; $i < $nbrFiliers; $i++) {
            $ids = $this->model->getIdFiliereByName($data['filiere'][$i]);
            if ($ids) {
                foreach ($ids as $id) {
                    $id_filieres[] = $id;
                }
            }
        }
        for ($i = 0; $i < $nbrFiliers; $i++) {
            $this->model->storeProfinFiliere($data, $id_filieres[$i]['id']);
        }
    }


    public function registerProf($data, $nbrFiliers)
    {
        $existingUser = $this->model->auth($data);

        if ($existingUser) {
            $_SESSION['error'] = "Cet utilisateur existe déjà.";
        } else {
            $inserted = $this->model->storeProf($data);
            if ($inserted) {
                $this->storeProf_Departement($data, $nbrFiliers);
                $this->registerProf_Filiere($data, $nbrFiliers);
                $_SESSION['success'] = "Le professeur a été enregistré avec succès.";
            }
        }
    }

    public function findProfByCin($cin)
    {
        $prof = $this->model->findByCin($cin);
        if ($prof) {
            $_SESSION['profs'] = $prof;
            return true;
        } else {
            return false;
        }
    }

    public function update($data, $cin)
    {
        $currentData = $this->model->findByCin($cin);

        if ($currentData !== false) {
            $mergedData = array_merge($currentData, $data);
            $updated = $this->model->updateProf($mergedData, $cin);
            if ($updated) {
                $_SESSION['update_success'] = "Mise à jour réussie";
            } else {
                $_SESSION['update_erreur'] = "Échec de la mise à jour";
            }
        } else {
            $_SESSION['existe_erreur'] = "Utilisateur non trouvé";
        }
    }

    public function deleteProf($cin)
    {
        $existe = $this->model->findByCin($cin);
        if ($existe) {
            $this->model->delete($cin);
            $_SESSION['delete_success'] = "Suppression avec success";
        } else {
            $_SESSION['delete_erreur'] = "Échec de supprimer";
        }
    }

    public function fetchDepartementforTeach()
    {
        $departements = $this->model->getDepartementforEachTeachers();
        $_SESSION['departement'] = $departements;
    }


    /*
     CRUD app pour les students 
      */
    public function fetchAllStudents()
    {
        $students = $this->model->getAllStudents();
        $_SESSION['students'] = $students;
    }

    public function getfiliereByCne()
    {
        $filiere = $this->model->getFiliere();
        $_SESSION['filiere'] = $filiere;
    }

    public function registerStudent($data)
    {
        $existingUser = $this->model->authEtud($data);
        if ($existingUser) {
            $_SESSION['error'] = "Cet utilisateur existe déjà.";
        } else {
        }
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
