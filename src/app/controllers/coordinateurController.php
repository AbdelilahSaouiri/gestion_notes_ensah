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
}
