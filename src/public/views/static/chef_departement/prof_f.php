<?php
session_start();
include_once "../../../../app/controllers/chefDepartementController.php";

use src\app\controllers\chefDepartementController;

$user = new chefDepartementController;
$cin = isset($_SESSION['chef_cin']) ? $_SESSION['chef_cin'] : "";
$departement = $user->getDepartement($cin);
$filiers = $user->getAllfiliersforDepartement($cin);
?>

<?php include "./masterPage.php" ?>
<main class="content">
    <div class="container-fluid p-0">
        <div class="container-fluid p-0">
            <h1 class="h3 p-2  bg-danger text-center mx-auto w-50 " style="border-radius: 10px;">
                <span class="text-white">
                    Choisir Une filière:
                </span>
            </h1>
            <div class="row mt-4">
                <?php foreach ($filiers as $filiere) : ?>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body text-center" style="background-color: #183258;border-radius:10px;">
                                <div class="row">
                                    <div class="col mt-0 ">
                                        <a href="./affectation_prof_modules.php?filiere=<?= $filiere['nom_filiere'] ?>" class="card-title text-white"><?php echo $filiere['nom_filiere']; ?></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
</main>
</div>
</div>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>