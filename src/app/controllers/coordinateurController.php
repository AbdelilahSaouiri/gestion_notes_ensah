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
}
