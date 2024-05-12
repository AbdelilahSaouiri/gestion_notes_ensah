<?php
session_start();
include_once "../../../../app/controllers/chefDepartementController.php";

use src\app\controllers\chefDepartementController;

$user = new chefDepartementController;
$ann_univ = isset($_GET['anne']) ? $_GET['anne'] : "";
$cin = isset($_SESSION['chef_cin']) ? $_SESSION['chef_cin'] : "";
$filiers = $user->getAllfiliersInDepartement($cin);
?>

<?php include "./masterPage.php" ?>

<main class="ms-3">
    <div class="container">
        <div>
            <div class="w-50 mx-auto my-4 fs-4 text-center p-1 font bg-danger" style="border-radius: 10px;">
                <span class=" d-block text-white py-2">Choisir Une filière : </span>
            </div>
        </div>
        <div class=" mx-auto text-white w-50 h-50 " style="background-color:#fff;">
            <nav class="mx-auto">
                <div class="nav nav-pills" id="nav-tab" role="tablist">
                    <?php foreach ($filiers as $key => $f) : ?>
                        <button style="font-size: 16px;width:169px;" class=" nav-link <?= $key === 0 ? 'active' : '' ?>" id="nav-<?= $f['id'] ?>-tab" data-bs-toggle="tab" data-bs-target="#nav-<?= $f['id'] ?>" type="button" role="tab" aria-controls="nav-<?= $f['id'] ?>" aria-selected="<?= $key === 0 ? 'true' : 'false' ?>">
                            <a class="text-dark" href="./semestre_archive.php?filiere=<?= $f['nom_filiere'] ?>&anne=<?= $ann_univ ?>"> <?= $f['nom_filiere'] ?></a>
                        </button>
                    <?php endforeach; ?>
                </div>
            </nav>

        </div>
    </div>
</main>

<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>