<?php
session_start();
include_once "../../../../app/controllers/studentController.php";

use src\app\controllers\studentController;

$user = new studentController;
$cin = isset($_SESSION['cin_etud']) ? $_SESSION['cin_etud'] : "";
$idfiliere = $user->getFiliereForStudentByCin($cin);
$filiere = $user->getFiliereNameById($idfiliere);
$date = new DateTime();
$currentDate = $date->format('m-d');
$semestre = ($currentDate > '02-15' && $currentDate < '08-01') ? 2 : 1;
$f = $filiere['nom_filiere'];
$salles = $user->getSalleCours($idfiliere['id_filiere']);
$salleCours = explode("_", $salles['salle_cours'])[1] == 'A' ?
    explode("_", $salles['salle_cours'])[0] . ' ' . 'Bloc A' :
    explode("_", $salles['salle_cours'])[0] . ' ' . 'Bloc B';



?>

<?php include_once "./masterPage.php"; ?>
<main class="mt-3 container-sm">
    <div class="text-center mb-4">
        <div class="btn p-2 text-white w-75 " style="background-color:#183258;border-radius: 10px;">
            <div class="d-flex justify-content-between">
                <div class="fs-4 me-4 "><span style="letter-spacing: 0.8px;">filière:</span> <?= $filiere['nom_filiere'] ?></div>
                <div class="fs-4 ms-4 me-2 ">Semestre: <span><?= $semestre ?></span></div>
                <div>Salle de Cours <span class="fs-4"> : <?= $salleCours ?></span></div>
            </div>
        </div>
    </div>
    <div class="mt-2 d-flex justify-content-center">
        <table class="table fs-6 table-bordered ">
            <thead>
                <tr class="bg-success w-25">
                    <th class="bg-white"></th>
                    <th class="text-white  " data-time="8h30-10h30">8:30->10:30</th>
                    <th class="text-white  " data-time="10h30-12h30">10:30->12:30</th>
                    <th class="text-white  " data-time="14h30-16h30">14:30->16:30</th>
                    <th class="text-white  " data-time="16h30-18h30">16:30->18h30</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Jours de la semaine
                $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];

                // Plages horaires
                $times = ['8h30-10h30', '10h30-12h30', '14h30-16h30', '16h30-18h30'];

                foreach ($days as $day) :  ?>
                    <tr class="bg-success w-25">
                        <td class="bg-succes text-white" data-day="<?= $day ?>"><?= strtoupper($day) ?></td>
                        <?php foreach ($times as $time) : ?>
                            <td class="bg-warning text-black-50 droppable-cell bg-white droppable w-25" data-day="<?= $day ?>" data-time="<?= $time ?>">
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class=" mt-2 text-danger ms-2">
        <p> * NB: les créneaux horaires alloués aux "TD--TP" sont à adapter par l'enseignant selon le descriptif de la filière <?= $filiere['nom_filiere'] ?></p>
        <p> ** LES ETUDIANTS SONT PRIES DE CONSULTER L’EMPLOI DU TEMPS POUR TOUT CHANGEMENT.</p>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const droppableCells = document.querySelectorAll(".droppable-cell");
        const filiere = "<?php echo $f ?>";
        // Charger les données du stockage local et afficher les noms de module pour le professeur spécifié
        function loadSavedModules() {
            droppableCells.forEach(cell => {
                const day = cell.getAttribute("data-day");
                const time = cell.getAttribute("data-time");
                const modulesData = JSON.parse(localStorage.getItem("emploi_filiere_" + filiere)) || {};
                const moduleInfo = modulesData[day + "-" + time];

                if (moduleInfo) {
                    cell.innerHTML = moduleInfo.moduleId;
                }
            });

        }

        loadSavedModules();

    });
</script>

<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>