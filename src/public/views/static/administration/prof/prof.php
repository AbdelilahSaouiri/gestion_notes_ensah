<?php

require_once "../../../../../app/controllers/adminController.php";

use src\app\controllers\adminController;

include_once "../layout.php";

$user = new adminController;

$user->fetchAllteachers();
$user->fetchDepartementforTeach();

?>
<div class="mt-4 card">
    <div class="card-body">
        <div class="card-title my-4">
            <div class="btn btn-outline-warning">
                <i class="bi bi-person-add text-primary" , style="font-size: 18px;"></i>
                <a class="text-dark font-monospace text-decoration-none" href="./addprof.php">Ajouter Un professeur</a>
            </div>
        </div>
        <table class="table table-bordered border-primary text-center">
            <thead>
                <tr>
                    <th scope="col">CIN</th>
                    <th scope="col">NOM</th>
                    <th scope="col">PRENOM</th>
                    <th scope="col">EMAIL_INSTITUTIONNEL</th>
                    <th scope="col">DEPARTEMENT</th>
                    <th scope="col">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['profs'] as $prof) : ?>
                    <tr>
                        <td><?= $prof['cin'] ?></td>
                        <td><?= $prof['nom'] ?></td>
                        <td><?= $prof['prenom'] ?></td>
                        <td><?= $prof['email_isntitutionnel'] ?></td>
                        <td><?= $_SESSION['departement']['nom_dep'] ?></td>
                        <td>
                            <button class="btn btn-primary">
                                <a class="text-white text-decoration-none" href="./updateProf.php?cin=<?= $prof['cin'] ?>"> Modifier</a>
                            </button>
                            <button class=" btn btn-danger">
                                <a class="text-white text-decoration-none" href="./deleteprof.php?cin=<?= $prof['cin'] ?>" ">Supprimer</a>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once "../../footer.php" ?>