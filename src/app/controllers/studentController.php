<?php

namespace  src\app\controllers;

use src\app\models\studentModel;

include_once __DIR__ . "../../../../vendor/autoload.php";



class studentController
{
    private $model;

    public function __construct()
    {
        $this->model = new studentModel;
    }

    public function getFiliereForStudentByCin($cin)
    {
        $id = $this->model->fetchFiliereForStudentByCin($cin);
        return $id;
    }
    public function getFiliereNameById($id)
    {
        return $this->model->fetchNameFiliereById($id['id_filiere']);
    }

    public function getDepartementNameById($id)
    {
        return $this->model->fetchNameDepartementByIdFiliere($id['id_filiere']);
    }

    public function getNotes($cin, $id, $ann)
    {
        return $this->model->fetchAllNotes($cin, $id, $ann);
    }

    public function getAllmodulesByFiliereName($filiere, $semestre)
    {
        return $this->model->fetchAllModulesByfiliere($filiere, $semestre);
    }

    public function getArchivesNotes($idfiliere, $idModule, $ann_univ)
    {
        return $this->model->fetchArchivesNotes($idfiliere, $idModule, $ann_univ);
    }

    public function getNameStudentByCIn($cin)
    {
        $student = $this->model->fetchNameOfStudentByCin($cin);
        return $student['nom'] . ' ' . $student['prenom'];
    }

    public function getSalleCours($idfiliere)
    {
        return $this->model->fetchSalleCours($idfiliere);
    }

    // public function getProfFullNameForModule($module)
    // {
    //     if (str_contains($module, '(TD/TP)'))
    //         return $this->model->fetchProfTdTp($module);
    //     else return $this->model->fetchNomProCourfForModule($module);
    // }
}
