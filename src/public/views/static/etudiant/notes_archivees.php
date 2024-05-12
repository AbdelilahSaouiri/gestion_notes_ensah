<?php
session_start();
include_once "../../../../app/controllers/studentController.php";
include_once "../../../../app/controllers/professeurController.php";

use src\app\controllers\professeurController;

$yearSystem = new DateTime();
$anne_univ = $yearSystem->format('Y');
$user = new professeurController;
$archive_annee_uinversitaire = $user->getAnneUinversitaires();

?>

<?php include_once "./masterPage.php"; ?>


<main class="container ">
    <div>
        <div class="w-50 mx-auto mt-5 fs-4 text-center p-1 font bg-danger" style="border-radius: 10px;">
            <span class=" d-block text-white py-2">Choisir Année universitaire : </span>
        </div>
    </div>
    <div class=" mt-5 mx-auto ">
        <?php foreach ($archive_annee_uinversitaire as $year) : ?>
            <div class="card w-50 mx-auto ">
                <div class="card-body text-primary fs-4 " style="background-color: #183258;opacity:0.9;border-radius:10px;">
                    <div class="d-flex justify-content-between">
                        <div class="ms-2 text-white">
                            <?= $year['anne_universitaire'] ?>
                        </div>
                        <div class="me-2">
                            <a href="./consulterArchive.php?anne=<?= $year['anne_universitaire']  ?>"> <i class="bi bi-folder-symlink fs-3 text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>