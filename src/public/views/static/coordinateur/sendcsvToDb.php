<?php

include_once "../../../../app/controllers/chefDepartementController.php";

use src\app\controllers\coordinateurController;
use src\app\controllers\chefDepartementController;

$user = new coordinateurController;
$chef = new chefDepartementController;
$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$cheminFichierCSV = "../../../../storage/filiere-$filiere.csv";
$idfiliere = $chef->getFiliereIdByCin($filiere);
$date = new DateTime();
$ann = $date->format('Y');
function lireFichierCSV($cheminFichier)
{
    $fichier = fopen($cheminFichier, 'r');
    $donnees = array();

    if ($fichier !== false) {
        // Ignorer l'en-tête
        fgetcsv($fichier);

        while (($ligne = fgetcsv($fichier, 1000, ";")) !== false) {
            $donnees[] = $ligne;
        }

        fclose($fichier);
    }

    return $donnees;
}

function convertirEnTableauAssociatif($donnees)
{
    $resultat = array();

    foreach ($donnees as $ligne) {
        $resultat[] = array(
            'cin' => $ligne[0],
            'cne' => $ligne[1],
            'nom' => $ligne[2],
            'prenom' => $ligne[3],
            'email_inst' => $ligne[4]
        );
    }

    return $resultat;
}

$donnees = lireFichierCSV($cheminFichierCSV);
$tableauAssociatif = convertirEnTableauAssociatif($donnees);

foreach ($tableauAssociatif as $asc) {
    $user->storeNewPromo($asc, $idfiliere, $ann);
}
