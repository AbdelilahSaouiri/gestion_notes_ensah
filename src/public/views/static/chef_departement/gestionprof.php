<?php
session_start();
include_once "../../../../app/controllers/chefDepartementController.php";

use src\app\controllers\chefDepartementController;

$user = new chefDepartementController;
$cin = isset($_SESSION['chef_cin']) ? $_SESSION['chef_cin'] : "";
$departement = $user->getDepartement($cin);
$profsDepartement = $user->getProfsSelonDepartement($departement['id_departement']);
?>

<?php include "./masterPage.php" ?>
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Département: <span class="text-primary"><?= isset($departement["nom_dep"]) ? $departement["nom_dep"] : "" ?></span></h5>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <a href="./addProf.php" class="btn btn-primary mb-3">Ajouter Un professeur</a>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th colspan="2" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($profsDepartement as $prof) : ?>
                    <tr>
                        <td><?= $prof['nom']  ?></td>
                        <td><?= $prof['prenom']  ?></td>
                        <td><button class="btn btn-success">
                                <a class="text-white  text-decoration-none" href="./modifierProf.php?cin=<?= $prof['cin'] ?>">Modifier</a>
                            </button></td>
                        <td><button class="btn btn-danger ">
                                <a class="text-white  text-decoration-none" href="./supprimerProf.php?cin=<?= $prof['cin'] ?>">Supprimer</a>
                            </button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>