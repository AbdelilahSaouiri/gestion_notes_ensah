<?php

namespace  src\app\controllers;

include_once __DIR__ . "../../../../vendor/autoload.php";

use src\app\models\chefDepartementModel;


class chefDepartementController
{
    private $model;

    public function __construct()
    {
        $this->model = new chefDepartementModel;
    }

    public function getDepartement($cin)
    {
        $departement = $this->model->fetchDepartement($cin);
        return $departement;
    }
    public function getAllfiliersforDepartement($cin)
    {
        $filiers = $this->model->fetchAllDepartementFilieres($cin);
        return $filiers;
    }

    public function getmodules($filiere, $semestre)
    {
        return $this->model->getAllModules($filiere, $semestre);
    }

    public function updateModule($module, $newModule)
    {
        if ($this->model->modifierModule($module, $newModule) == true) {
            return true;
        } else {
            return false;
        }
    }

    public function getProfsSelonDepartement($departement)
    {
        return $this->model->fetchProfsByDepartementId($departement);
    }

    public function saveprof($data, $idDepartement)
    {
        $cin = isset($data['cin']) ? $data['cin'] : "";
        $userExist = $this->model->authProf($cin);
        if ($userExist) {
            $_SESSION['prof_exists'] = "ce prof déja existe";
        } else {
            $res1 = $this->model->storeProf($data);
            $res2 = $this->model->storeProfInDepartement($data, $idDepartement);
            if ($res1 == true && $res2 == true) {
                $_SESSION['saved_success'] = "le prof a été enregistré avec succés ";
            }
        }
    }
    public function deleteProfesseur($cin)
    {
        return $this->model->delete($cin);
    }


    public function findProfByCin($cin)
    {
        return $this->model->findByCin($cin);
    }

    public function updateProfesseur($data, $cin)
    {
        $currentData = $this->model->findByCin($cin);

        if ($currentData) {
            $mergedData = array_merge($currentData, $data);
            $updated = $this->model->updateProf($mergedData, $cin);
            return $updated;
        }
    }

    public function storeProf_Filiere($data, $nom_filiere)
    {
        return $this->model->storeProfInFiliere($data, $nom_filiere);
    }
}
