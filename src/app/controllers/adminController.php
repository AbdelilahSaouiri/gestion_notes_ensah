<?php

namespace  src\app\controllers;

include_once __DIR__ . "../../../../vendor/autoload.php";

use src\app\models\adminModel;


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
    public function getfiliereName($data)
    {
        $filiere = $this->model->getIdFiliereByName($data['filiere']);
        return $filiere;
    }
    public function fetchAllStudents()
    {
        $students = $this->model->getAllStudents();
        $_SESSION['students'] = $students;
        $nbrRows = count($_SESSION['students']);
        $filiers = [];
        for ($i = 0; $i < $nbrRows; $i++) {
            $filiers[] = $this->model->getNameByIdFiliere($_SESSION['students'][$i]['id_filiere']);
        }
        $_SESSION['filiers'] = $filiers;
    }

    public function findStudentByCin($cin)
    {
        $etud = $this->model->findEtudByCin($cin);
        if ($etud) {
            $_SESSION['etudiant'] = $etud;
            return true;
        } else {
            return false;
        }
    }

    public function registerStudent($data)
    {
        $existingUser = $this->model->authEtud($data);
        if ($existingUser) {
            $_SESSION['etud_error'] = "Cet utilisateur existe déjà.";
        } else {
            $id = $this->model->getIdFiliereByName($data);
            $saved = $this->model->storeStudent($data, $id);
            if ($saved == true) {
                $_SESSION['etud_success'] = "L'etudiant a été enregistré avec succès.";
            }
        }
    }

    public function deleteEtudiant($cin)
    {
        $existe = $this->model->findEtudByCin($cin);
        if ($existe) {
            $this->model->deleteEtud($cin);
        } else {
            $_SESSION['delete_erreur'] = "Échec de supprimer";
        }
    }

    public function updateStudent($data, $cin)
    {
        $currentData = $this->model->findEtudByCin($cin);

        if ($currentData !== false) {
            $mergedData = array_merge($currentData, $data);
            $updated = $this->model->modifierStudent($mergedData, $cin);
            if ($updated) {
                $_SESSION['update_etud_success'] = "Mise à jour réussie";
            } else {
                $_SESSION['update_etud_erreur'] = "Échec de la mise à jour";
            }
        } else {
            $_SESSION['existe_erreur'] = "Utilisateur non trouvé";
        }
    }

    /*CRUD COORDINATEUR*/

    public function registerCoordinateur($data)
    {

        $inserted = $this->model->storeCord($data);
        if ($inserted == true) {
            $_SESSION['cord_success'] = "Le Coordinateur a été enregistré avec succès.";
        }
    }

    public function fetchAllCoordinateurs()
    {
        $coordinateurs = $this->model->getAllcoordinateurs();
        $_SESSION['coordinateurs'] = $coordinateurs;
    }

    public function deleteCordinateur($cin)
    {
        $existe = $this->model->find_Cord_By_Cin($cin);
        if ($existe) {
            $this->model->deleteCord($cin);
            $_SESSION['delete_cord_success'] = "Suppression avec success";
        } else {
            $_SESSION['delete_cord_erreur'] = "Échec de supprimer";
        }
    }

    public function updateCoordinateur($data, $cin)
    {
        $currentData = $this->model->find_Cord_By_Cin($cin);

        if ($currentData !== false) {
            $mergedData = array_merge($currentData, $data);
            $updated = $this->model->updateCoordinateur($mergedData, $cin);
            if ($updated) {
                $_SESSION['cord_success'] = "Mise à jour réussie";
            } else {
                $_SESSION['cord_erreur'] = "Échec de la mise à jour";
            }
        } else {
            $_SESSION['existe_erreur'] = "Utilisateur non trouvé";
        }
    }

    public function findCordByCin($cin)
    {
        $cord = $this->model->find_Cord_By_Cin($cin);
        if ($cord) {
            $_SESSION['cord'] = $cord;
            return true;
        } else {
            return false;
        }
    }

    //chef de departement
    public function fetchAllchefDepartement()
    {
        $chef_departements = $this->model->getAllChefDepartements();
        $_SESSION['chef_departements'] = $chef_departements;
    }

    public function fetchNomDepartement($cin)
    {
        $departement = $this->model->getDepartementName($cin);
        return $departement['nom_dep'];
    }

    public function registerChefDepartemet($data)
    {
        if (isset($data['cin'])) {
            $existingUser = $this->model->auth_Chef_departement($data['cin']);
            if ($existingUser) {
                $_SESSION['chef_dep_error'] = "Cet utilisateur existe déjà.";
                return;
            }
        }
        $inserted = $this->model->store_Chef_Departement($data);
        if ($inserted == true) {
            $this->model->store_cin_chef_departement_in_departement($data['departement'], $data['cin']);
            $_SESSION['chef_dep_success'] = "Le Chef de Departement a été enregistré avec succès.";
        }
    }

    public function deleteChefDepartement($cin)
    {
        $existe = $this->model->find_chef_departement_by_cin($cin);
        if ($existe) {
            $this->model->delete_Chef_Departement($cin);
            $this->model->deleteForeignkeyfromDepartement($cin);
        }
    }

    public function updateChef_Departement($data, $cin)
    {
        $currentData = $this->model->find_chef_departement_by_cin($cin);

        if ($currentData !== false) {
            $mergedData = array_merge($currentData, $data);
            $updated = $this->model->update_Chef_Departement($mergedData, $cin);
            $this->model->updateCinIndepartement($data, $cin);
            if ($updated) {
                $_SESSION['chef_dep_success'] = "Mise à jour réussie";
            } else {
                $_SESSION['chef_dep_error'] = "Échec de la mise à jour";
            }
        } else {
            $_SESSION['existe_erreur'] = "Utilisateur non trouvé";
        }
    }

    public function fetchChefDepartementByCin($cin)
    {
        $chef_dep = $this->model->find_chef_departement_by_cin($cin);
        if ($chef_dep) {
            $_SESSION['chef_dep'] = $chef_dep;
            return true;
        } else {
            return false;
        }
    }
}

// $user = new adminController;

// $user->fetchDepartementforTeach();
