<?php

namespace  src\app\controllers;

use src\app\models\professeurModel;

include_once __DIR__ . "../../../../vendor/autoload.php";



class professeurController
{
    private $model;

    public function __construct()
    {
        $this->model = new professeurModel;
    }

    public function getFilieresForProfesseur($cin)
    {
        return $this->model->getfilieresBycin($cin);
    }

    public function getDepartementByCinProf($cin_prof)
    {
        return $this->model->fetchDepartement($cin_prof);
    }

    public function getAllStudentsByFiliere($idFiliere, $anne_univ)
    {
        return $this->model->fetchStudentByFiliere($idFiliere, $anne_univ);
    }

    public function getIdFiliereByName($nomFiliere)
    {
        return $this->model->fetchIdFiliere($nomFiliere);
    }

    public function stockerNotes($data, $student)
    {
        $exist = $this->model->auth($data['id_module'], $student);
        if ($exist) {
            return false;
        } else {
            return $this->model->storeNotes($data, $student);
        }
    }

    public function getModuleId($module)
    {
        $id_module = $this->model->fetchIdModuleByName($module);
        return $id_module;
    }

    public function getFiliereId($filiere)
    {
        $id_Filiere = $this->model->fetchIdFiliere($filiere);
        return $id_Filiere;
    }
    public function getAllNotes($idFiliere, $idModule, $anne_univ)
    {
        return  $this->model->fetchAllNotes($idFiliere, $idModule, $anne_univ);
    }

    public function getNameStudentByCIn($cin)
    {
        $student = $this->model->fetchNameOfStudentByCin($cin);
        return $student['nom'] . ' ' . $student['prenom'];
    }

    public function getSemsetre($module)
    {
        return $this->model->fetchSemestreByModuleId($module);
    }

    public function updateNote($data)
    {
        return $this->model->updateNoteStudent($data);
    }

    public function getAnneUinversitaires()
    {
        return $this->model->fetchAnneUniversitaire();
    }
}
