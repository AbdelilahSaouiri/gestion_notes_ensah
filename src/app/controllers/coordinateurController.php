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

    public function getfiliere()
    {
        $cin = "";
        if (isset($_SESSION['cin']))
            $cin = $_SESSION['cin'];
        $filieres = $this->model->getFilieresForEachCoordinateur($cin);
        $_SESSION['filieres'] = $filieres;
    }
}
