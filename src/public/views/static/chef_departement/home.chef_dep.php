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
        <h1 class="h3 px-2 py-3 bg-danger w-50 " style="border-radius: 10px;">
            <span class="ms-1 mt-3 text-dark "> Département :</span>
            <strong class="text-white"> <?php echo isset($departement["nom_dep"]) ? $departement["nom_dep"] : "" ?>
            </strong>
        </h1>
        <div class="row mt-4">
            <?php foreach ($filiers as $filiere) : ?>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body" style="background-color: #183258;border-radius:10px;">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title text-white text-center"><?php echo $filiere['nom_filiere']; ?></h5>
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