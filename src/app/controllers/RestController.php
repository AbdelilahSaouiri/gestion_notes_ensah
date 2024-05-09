<?php

namespace  src\app\controllers;

use src\app\models\RestModel;

include_once __DIR__ . "../../../../vendor/autoload.php";

class RestController
{
    private $model;

    public function __construct()
    {
        $this->model = new RestModel;
    }

    public function getCinByName($firstName, $lastName)
    {
        return $this->model->fetchCinByfullName($firstName, $lastName);
    }

    public function affecterModuleProf($data, $idDepartement)
    {
        foreach ($data as $moduleData) {
            if (!empty($moduleData["course_prof"]) && !empty($moduleData["tdtp_prof"])) {
                $courseProfName = explode(' ', $moduleData["course_prof"]);
                $courseProfFirstName = $courseProfName[0];
                $courseProfLastName = $courseProfName[1];
                $tdtpProfName = explode(' ', $moduleData["tdtp_prof"]);
                $tdtpProfFirstName = $tdtpProfName[0];
                $tdtpProfLastName = $tdtpProfName[1];
                $cin_prof_cour = $this->getCinByName($courseProfFirstName, $courseProfLastName);
                $cin_prof_td_tp = $this->getCinByName($tdtpProfFirstName, $tdtpProfLastName);
                if ($cin_prof_cour && $cin_prof_td_tp) {
                    $result = $this->model->updateModuleProfessors($moduleData["nom_module"], $cin_prof_cour['cin'],  $cin_prof_td_tp['cin']);
                    return $result;
                }
            }
        }
    }
}
