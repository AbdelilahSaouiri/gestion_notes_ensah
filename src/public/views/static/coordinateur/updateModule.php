<?php

use src\app\controllers\chefDepartementController;

include_once "../../../../app/controllers/chefDepartementController.php";

$module = isset($_GET['module']) ? $_GET['module'] : "";

if (isset($_POST['newModule']) && isset($_POST['submit'])) {
    $newModule = isset($_POST['newModule']) ? $_POST['newModule'] : "";
    $user = new chefDepartementController;
    if ($user->updateModule($module, $newModule) == true) {
        header("Location:./gestionModules.php");
        exit();
    }
}
?>

<?php include "./masterPage.php" ?>

<main class="content">
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Modifier le module:</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 m-auto">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="form-label" for="newModule">
                                    <h5 class="card-title mb-0"> Le Nom de Module :</h5>
                                </label>
                                <input type="text" class="form-control" name="newModule" value="<?= $module ?>" placeholder="Entrer le nom du module">
                            </div>
                            <div class="mb-3 d-grid">
                                <button type="submit" name="submit" class="btn btn-primary btn-block">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>