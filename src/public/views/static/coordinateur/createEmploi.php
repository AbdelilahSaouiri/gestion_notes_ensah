<?php
session_start();
include_once "../../../../app/controllers/coordinateurController.php";
include_once "../../../../app/controllers/chefDepartementController.php";

use src\app\controllers\chefDepartementController;
use src\app\controllers\coordinateurController;

$user = new chefDepartementController;
$cord = new coordinateurController;
$cin_cord = isset($_SESSION['cin_cord']) ? $_SESSION['cin_cord'] : "";
$departement = $cord->getDepartement($cin_cord);
$filiers = $cord->getfiliere($cin_cord);
$nbrFiliere = count($filiers);
$allProfs = [];

foreach ($filiers as $f) {
    // Récupérer les professeurs pour cette filière
    $profs = $cord->getProfsSelonFilieres($f['id']);
    // Fusionner les tableaux de professeurs
    $allProfs = array_merge($allProfs, $profs);
}

$allProfs = array_unique($allProfs, SORT_REGULAR);


?>

<?php include_once "./masterPage.php"  ?>
<main class="content">
    <div class="card w-50">
        <div class="card-body">
            <h4>
                <span class="font-italic">Département: </span>
                <strong class="text-primary"> <?php echo isset($departement["nom_dep"]) ? $departement["nom_dep"] : "" ?>
                </strong>
            </h4>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6">
            <table class="table  table-bordered">
                <thead>
                    <tr>
                        <th class="bg-warning">
                            Emploi du Professeur
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($allProfs as $prof) : ?>
                        <tr>
                            <td class="bg-primary text-white text-center d-flex justify-content-between align-items-center">
                                <span class="mx-3"><?= $prof['nom'] . ' ' . $prof['prenom'] ?></span>
                                <a href="./emploiProf.php?nomProf=<?= $prof['nom'] ?>&prenom=<?= $prof['prenom'] ?>&filiere=<?= $prof['nom_filiere'] ?>&cin_prof=<?= $prof['cin'] ?>" class="text-white"><i class="bi bi-pencil-square me-2 fs-4 text-white"></i></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="bg-warning" scope="col">Emploi du Filière</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($filiers as $f) : ?>
                            <td class="bg-primary text-center ">
                                <h4 class="text-white mb-2"><?= $f['nom_filiere'] ?></h4>
                                <div class="d-flex justify-content-around">
                                    <a href="emploiFiliere.php?filiere=<?= $f['nom_filiere'] ?>&semestre=1" class="btn btn-outline-light">S1</a>
                                    <a href="emploiFiliere.php?filiere=<?= $f['nom_filiere'] ?>&semestre=2" class="btn btn-outline-light">S2</a>
                                </div>
                            </td>
        </div>
        </tr>
    <?php endforeach ?>
    </tbody>
    </table>
    </div>
    </div>
</main>
</div>
</div>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>