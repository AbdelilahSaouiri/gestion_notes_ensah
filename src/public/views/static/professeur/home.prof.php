<?php $title = "Dashboard Coordinateur"; ?>
<?php include_once "../header.php"; ?>
<?php

?>
<div class="container">
    <div class="row">
        <?php
        if (isset($_SESSION['filieres'])) {
            $filieres = $_SESSION['filieres'];
            if (!empty($filieres)) {
                foreach ($filieres as $filiere) {
        ?>
                    <div class="d-flex justify-content-end">
                        <div class=" col-md-3">
                            <div class="btn btn-success mb-2 w-100"><?= $filiere['nom_filiere'] ?></div>
                        </div>
                    </div>
        <?php
                }
            }
        }
        ?>
    </div>
</div>

<div class="mt-4 d-flex justify-content-between">
    <div class="col">
        <div class="row">
            <div class="col">
                <div class="btn btn-primary  mb-2 w-25"><i class="bi bi-clipboard me-5"></i>Consulter les notes</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="btn btn-primary w-25 mb-2"><i class="bi bi-calendar2-event me-3"></i>affectation des modules</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="btn btn-primary w-25 mb-2"><i class="bi bi-archive me-3"></i> Gestion la liste les etudiants </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="btn btn-primary w-25 mb-2"><i class="bi bi-archive me-3"></i> Gestion les modules </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="btn btn-primary w-25 mb-2"><i class="bi bi-archive me-3"></i> consulter archive de notes</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="btn btn-primary w-25 mb-2"><i class="bi bi-archive me-3"></i><a class="text-white text-decoration-none" href="./empoliTemps.php">Gestion de l'emploi du temps</a> </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="btn btn-primary w-25 mb-2"><i class="bi bi-archive me-4"></i>Collecter les notes</div>
            </div>
        </div>
    </div>
</div>
<form action="../../../../app/controllers/coordinateurController.php" method="post">
    <input type="hidden" name="cin" value=" <?= isset($_SESSION['cin']) ? $_SESSION['cin'] : "" ?>">
</form>
<?php include_once "../footer.php" ?>
</div>
</body>

</html>