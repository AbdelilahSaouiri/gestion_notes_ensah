<?php
session_start();
include_once "../../../../app/controllers/professeurController.php";

use src\app\controllers\professeurController;

$user = new professeurController;
$cin_prof = isset($_SESSION['cin']) ? $_SESSION['cin'] : "";
$departement = $user->getDepartementByCinProf($cin_prof);
$nomProf = isset($_SESSION['nom']) ? $_SESSION['nom'] : "";
$prenomProf = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : "";
$filiers = $user->getFilieresForProfesseur($cin_prof);
$salles = $user->getSalleCoursTd($cin_prof);
$salleCours = explode("_", $salles['num_salle_cour'])[1] == 'A' ?
    explode("_", $salles['num_salle_cour'])[0] . ' ' . 'Bloc A' :
    explode("_", $salles['num_salle_cour'])[0] . ' ' . 'Bloc B';
$salleTd = explode("_", $salles['num_salle_td_tp'])[1] == 'A' ?
    explode("_", $salles['num_salle_td_tp'])[0] . ' ' . 'Bloc A' :
    explode("_", $salles['num_salle_td_tp'])[0] . ' ' . 'Bloc B';

?>

<?php include_once "./masterPage.php"; ?>
<main class="content">
    <div class="row">
        <div class="my-3 w-75 mx-auto p-3 text-white " style="background-color:#183258;border-radius:10px;">
            <div class="ms-1 me-4 d-inline ">Salle De Cours : <span class="ms-1"><?= $salleCours ?></span> </div>
            <div class="d-inline" style="float: right;">Salle de TD/TP : <span class="ms-1"><?= $salleTd ?></span> </div>
        </div>
        <div class="mt-2 mx-3 d-flex justify-content-center">
            <table class="table  fs-5 table-bordered ">
                <thead>
                    <tr class="bg-success w-25">
                        <th class="bg-white"></th>
                        <th class="text-white  " data-time="8h30-10h30">8:30->10:30</th>
                        <th class="text-white  " data-time="10h30-12h30">10:30->12:30</th>
                        <th class="text-white  " data-time="14h30-16h30">14:30->16:30</th>
                        <th class="text-white  " data-time="16h30-18h30">16:30->18:30</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-success w-25">
                        <td class="bg-succes text-white" data-day="lundi">LUNDI</td>
                        <td class="bg-warning text-black-50 droppable-cell bg-white droppable w-25" data-day="lundi" data-time="8h30-10h30"></td>
                        <td class="bg-warning droppable-cell bg-white droppable w-25" data-day="lundi" data-time="10h30-12h30"></td>
                        <td class="bg-warning droppable-cell bg-white droppable w-25" data-day="lundi" data-time="14h30-16h30"></td>
                        <td class="bg-warning droppable-cell bg-white droppable w-25" data-day="lundi" data-time="16h30-18h30"></td>
                    </tr>

                    <tr class="bg-success w-25">
                        <td class="text-white" data-day="mardi">MARDI</td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="mardi" data-time="8h30-10h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="mardi" data-time="10h30-12h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="mardi" data-time="14h30-16h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="mardi" data-time="16h30-18h30"></td>
                    </tr>
                    <tr class=" bg-success w-25">
                        <td class="text-white" data-day="mercredi">MERCREDI</td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="mercredi" data-time="8h30-10h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="mercredi" data-time="10h30-12h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="mercredi" data-time="14h30-16h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="mercredi" data-time="16h30-18h30"></td>
                    </tr>
                    <tr class="bg-success w-25">
                        <td class="text-white" data-day="jeudi">JEUDI</td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="jeudi" data-time="8h30-10h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="jeudi" data-time="10h30-12h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="jeudi" data-time="14h30-16h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="jeudi" data-time="16h30-18h30"></td>
                    </tr>
                    <tr class="bg-success w-25">
                        <td class="text-white" data-day="vendredi">VENDREDI</td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="vendredi" data-time="8h30-10h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="vendredi" data-time="10h30-12h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="vendredi" data-time="14h30-16h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="vendredi" data-time="16h30-18h30"></td>
                    </tr>
                    <tr class="bg-success w-25">
                        <td class="bg-success text-white" data-day="samedi">SAMEDI</td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="samedi" data-time="8h30-10h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="samedi" data-time="10h30-12h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25" data-day="samedi" data-time="14h30-16h30"></td>
                        <td class=" droppable-cell bg-white droppable w-25 " data-day="samedi" data-time="16h30-18h30"></td>
                    </tr>
                </tbody>
            </table>
        </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const droppableCells = document.querySelectorAll(".droppable-cell");
        const nomProf = "<?php echo $nomProf ?>";
        const prenomProf = "<?php echo $prenomProf ?>";
        const profName = nomProf + " " + prenomProf;

        // Charger les données du stockage local et afficher les noms de module pour le professeur spécifié
        function loadSavedModules() {
            droppableCells.forEach(cell => {
                const day = cell.getAttribute("data-day");
                const time = cell.getAttribute("data-time");
                const modulesData = JSON.parse(localStorage.getItem("modules_" + profName)) || {};
                const moduleInfo = modulesData[day + "_" + time];

                if (moduleInfo) {
                    cell.textContent = moduleInfo.moduleId;
                }
            });
        }

        loadSavedModules();
    });
</script>
</div>
</div>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>