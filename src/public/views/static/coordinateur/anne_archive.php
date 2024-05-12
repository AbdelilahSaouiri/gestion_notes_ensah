<?php
session_start();
include_once "../../../../app/controllers/coordinateurController.php";

use src\app\controllers\coordinateurController;

$user = new coordinateurController;
$cin_cord = isset($_SESSION['cin_cord']) ? $_SESSION['cin_cord'] : "";
$ann_univ = isset($_GET['anne']) ? $_GET['anne'] : "";
$filiers = $user->getfiliere($cin_cord);
?>
<?php include_once "./masterPage.php"  ?>
<main class="ms-3">
    <div class="container">
        <div>
            <div class="w-50 mx-auto my-4 fs-4 text-center p-1 font bg-danger" style="border-radius: 10px;">
                <span class=" d-block text-white py-2">Choisir Une filière : </span>
            </div>
        </div>
        <div class=" mx-auto text-white w-50" style="background-color:#fff;">
            <nav class="mx-auto">
                <div class="nav nav-pills" id="nav-tab" role="tablist">
                    <?php foreach ($filiers as $key => $f) : ?>
                        <button style="font-size: 16px;width:169px;" class=" nav-link <?= $key === 0 ? 'active' : '' ?>" id="nav-<?= $f['id'] ?>-tab" data-bs-toggle="tab" data-bs-target="#nav-<?= $f['id'] ?>" type="button" role="tab" aria-controls="nav-<?= $f['id'] ?>" aria-selected="<?= $key === 0 ? 'true' : 'false' ?>">
                            <?= $f['nom_filiere'] ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </nav>
            <div class="tab-content " id="pills-tabContent">
                <?php foreach ($filiers as $key => $f) : ?>
                    <div class="tab-pane  fade <?= $key === 0 ? 'show active' : '' ?>" id="nav-<?= $f['id'] ?>" role="tabpanel" aria-labelledby="nav-<?= $f['id'] ?>-tab">
                        <div class="p-3" style="border-radius: 0 0 10px 10px;">
                            <i class="d-block mt-3 pb-4 ms-4 text-success fs-3 bi bi-bookmark-check-fill">
                                <span style="font-size: 19px;" class=" ms-2 text-dark">
                                    Semestre 1
                                    <a href="./voirNotesArchivees.php?filiere=<?= $f['nom_filiere'] ?>&anne=<?= $ann_univ ?>&semestre=1">
                                        <i class="ms-3 text-danger fs-3 bi bi-folder-symlink-fill"></i>
                                    </a>
                                </span>

                            </i>
                            <i class="d-block  pb-4 ms-4 text-success fs-3 bi bi-bookmark-check-fill">
                                <span style="font-size: 19px;" class=" ms-2 text-dark">
                                    Semestre 2
                                    <a href="./voirNotesArchivees.php?filiere=<?= $f['nom_filiere'] ?>&anne=<?= $ann_univ ?>&semestre=2">
                                        <i class="ms-3 text-danger fs-3 bi bi-folder-symlink-fill"></i>
                                    </a>
                                </span>

                            </i>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>