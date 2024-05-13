<?php
session_start();
include_once "../../../../app/controllers/coordinateurController.php";

use src\app\controllers\coordinateurController;

$user = new coordinateurController;

$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$filiereId = $user->getIdFiliereByName($filiere);
$ann_uinversitaire = isset($_GET['anne']) ? $_GET['anne'] : "";

$students = $user->getAllStudentsByFilierId($filiereId['id'], $ann_uinversitaire);


?>

<?php include_once "./masterPage.php"  ?>
<main>
    <div class="container">
        <div>
            <div class="w-75 mx-auto my-4 fs-4 text-center text-white p-2 font bg-danger" style="border-radius: 10px;">
                La Liste Des Étudiants Inscrits Au filiere <span><?= $filiere ?></span> Pour l'Année Universitaire <?= $ann_uinversitaire ?>
            </div>
        </div>
        <div class="mt-4">
            <table class="table table-bordered fs-6">
                <thead style="background-color: #183258">
                    <tr class="text-center">
                        <th class="text-white">CIN</th>
                        <th class="text-white">CNE</th>
                        <th class="text-white">NOM</th>
                        <th class="text-white">PRÉNOM</th>
                        <th class="text-white ">EMAIL INSTITUTIONNEL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) : ?>
                        <tr class="text-center fs-5">
                            <td><?= $student['cin'] ?></td>
                            <td><?= $student['cne'] ?></td>
                            <td><?= $student['nom'] ?></td>
                            <td><?= $student['prenom'] ?></td>
                            <td><?= $student['email_institutionnel'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</main>



<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>