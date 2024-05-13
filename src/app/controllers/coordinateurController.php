<?php

namespace  src\app\controllers;

include_once __DIR__ . "../../../../vendor/autoload.php";

use src\app\models\coordinateurModel;

class coordinateurController
{
    private $model;

    public function __construct()
    {
        $this->model = new coordinateurModel;
    }

    public function StorenewPromo($data, $id, $ann)
    {
        if ($this->model->auth($data)) {
            return false;
        }
        return $this->model->stockerNewPromo($data, $id, $ann);
    }

    public function getDepartement($cin)
    {
        return $this->model->fetchDepartement($cin);
    }
    public function getfiliere($cin)
    {
        return $this->model->getFilieresForEachCoordinateur($cin);
    }

    public function getModulesByFiliere($filiere, $semestre)
    {
        return $this->model->fetchModules_filiere($filiere, $semestre);
    }

    public function getProfsSelonFilieres($id_filiere)
    {
        return $this->model->fetchProfsForFiliere($id_filiere);
    }

    public function getModulesForeachProfesseur($cin_prof)
    {
        return $this->model->fetchModulesForProf($cin_prof);
    }

    public function stockerProfSalle($salle_cours, $salle_td_tp, $cin_prof)
    {
        if ($this->model->authProfSalle($cin_prof)) {
            return false;
        }
        return $this->model->storeProfSalle($salle_cours, $salle_td_tp, $cin_prof);
    }

    public function stockerFiliereSalle($salleCours, $idFiliere)
    {
        if ($this->model->authFiliereSalle($idFiliere)) {
            $this->model->updateSalle($idFiliere, $salleCours);
        }
        return $this->model->storeFiliereSalle($salleCours, $idFiliere);
    }

    public function getIdFiliereByName($filiere)
    {
        return $this->model->fetchIdFiliereByName($filiere);
    }

    public function getAllStudentsByFilierId($filiereId, $ann_uinversitaire)
    {
        return $this->model->fetchALlStudentsByFiliereId($filiereId, $ann_uinversitaire);
    }
}
