<?php
session_start();
include_once "../../../../app/controllers/coordinateurController.php";

use src\app\controllers\coordinateurController;

$user = new coordinateurController;
$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$idFiliere = $user->getIdFiliereByName($filiere);
$semestre = isset($_GET['semestre']) ? $_GET['semestre'] : "";
$modules = $user->getModulesByFiliere($filiere, $semestre);
if (isset($_POST['submit'])) {
    $salleCours = isset($_POST['salle_cours']) ? $_POST['salle_cours'] : "";
    $registred = $user->stockerFiliereSalle($salleCours, $idFiliere['id']);
}
?>
<?php include_once "./masterPage.php"  ?>
<main class="content">
    <div class="container">
        <div class="card w-50 m-auto ">
            <div class="card-body bg-primary text-white  text-center" style="border-radius: 10px;">
                <div class="d-flex justify-content-between fs-4">
                    <span class="h5 text-white">FILIERE: <?= $filiere ?></span>
                    <span class="h5 text-white">SEMESTRE: <?= $semestre ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3 fs-5 d-flex justify-content-center">
        <table class="table table-bordered ">
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
    <div class="d-flex justify-content-between gap-2">
        <?php foreach ($modules as $module) : ?>
            <div class="btn btn-primary btn-sm w-100" draggable="true" id="drop-zone" data-module-id="<?= $module['nom_modules'] ?>">
                <?= $module['nom_modules'] ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="d-flex justify-content-between gap-2">
        <?php foreach ($modules as $module) : ?>
            <div class="mt-2 btn btn-primary btn-sm w-100" draggable="true" id="drop-zone" data-module-id="<?= $module['nom_modules'] ?> (TD/TP)">
                <?= $module['nom_modules'] ?> (TD/TP)
            </div>
        <?php endforeach; ?>
    </div>
    <div class="container-sm text-center w-50 mt-5">
        <form action="" method="post">
            <select name="salle_cours" class="form-select" aria-label="Default select example">
                <option selected>Salle De Cours</option>
                <option value="1_A">Salle 1 Bloc A</option>
                <option value="2_A">Salle 2 Bloc A</option>
                <option value="3_A">Salle 3 Bloc A</option>
                <option value="4_A">Salle 4 Bloc A</option>
                <option value="5_A">Salle 5 Bloc A</option>
                <option value="6_A">Salle 6 Bloc A</option>
                <option value="7_A">Salle 8 Bloc A</option>
                <option value="8_A">Salle 7 Bloc A</option>
                <option value="9_A">Salle 9 Bloc A</option>
                <option value="10_A">Salle 10 Bloc A</option>
                <option value="11_A">Salle 11 Bloc A</option>
                <option value="12_A">Salle 12 Bloc A</option>
                <option value="13_A">Salle 13 Bloc A</option>
                <option value="14_A">Salle 14 Bloc A</option>
                <option value="15_A">Salle 15 Bloc A</option>
                <option value="16_A">Salle 16 Bloc A</option>
                <option value="17_A">Salle 17 Bloc A</option>
                <option value="1_B">Salle 1 Bloc B</option>
                <option value="2_B">Salle 2 Bloc B</option>
                <option value="3_B">Salle 3 Bloc B</option>
                <option value="4_B">Salle 4 Bloc B</option>
                <option value="5_B">Salle 5 Bloc B</option>
                <option value="6_B">Salle 6 Bloc B</option>
                <option value="8_B">Salle 8 Bloc B</option>
                <option value="9_B">Salle 9 Bloc B</option>
                <option value="10_B">Salle 10 Bloc B</option>
            </select>
            <!-- <select name="salle_td_tp" class="form-select" aria-label="Default select example">
                <option selected>Salle De TD/TP</option>
                <option value="1_A">Salle 1 Bloc A</option>
                <option value="2_A">Salle 2 Bloc A</option>
                <option value="3_A">Salle 3 Bloc A</option>
                <option value="4_A">Salle 4 Bloc A</option>
                <option value="5_A">Salle 5 Bloc A</option>
                <option value="6_A">Salle 6 Bloc A</option>
                <option value="8_A">Salle 8 Bloc A</option>
                <option value="8_A">Salle 7 Bloc A</option>
                <option value="9_A">Salle 9 Bloc A</option>
                <option value="10_A">Salle 10 Bloc A</option>
                <option value="11_A">Salle 11 Bloc A</option>
                <option value="12_A">Salle 12 Bloc A</option>
                <option value="13_A">Salle 13 Bloc A</option>
                <option value="14_A">Salle 14 Bloc A</option>
                <option value="15_A">Salle 15 Bloc A</option>
                <option value="16_A">Salle 16 Bloc A</option>
                <option value="17_A">Salle 17 Bloc A</option>
                <option value="1_B">Salle 1 Bloc B</option>
                <option value="2_B">Salle 2 Bloc B</option>
                <option value="3_B">Salle 3 Bloc B</option>
                <option value="4_B">Salle 4 Bloc B</option>
                <option value="5_B">Salle 5 Bloc B</option>
                <option value="6_B">Salle 6 Bloc B</option>
                <option value="8_B">Salle 8 Bloc B</option>
                <option value="9_B">Salle 9 Bloc B</option>
                <option value="10_B">Salle 10 Bloc B</option>
            </select> -->
            <div class="mt-3 text-center">
                <button name="submit" class="btn btn-success w-25">Valider</button>
            </div>
        </form>
    </div>
    <div class="mt-3 text-center">
        <button id="resetBtn" class="btn btn-danger">Réinitialiser</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const draggableElements = document.querySelectorAll("[draggable=true]");
            const droppableCells = document.querySelectorAll(".droppable-cell");
            let draggedModule = null;

            // Fonction pour obtenir le nom de la filière
            function getFiliere() {
                const params = new URLSearchParams(window.location.search);
                return params.get('filiere') || '';
            }

            // Fonction pour obtenir le semestre
            function getSemestre() {
                const params = new URLSearchParams(window.location.search);
                return params.get('semestre') || '';
            }

            // Objet pour stocker les informations des modules
            let emploi_filiere_nomFiliere = {};

            // Drag Start
            draggableElements.forEach(elem => {
                elem.addEventListener("dragstart", function(event) {
                    draggedModule = elem.dataset.moduleId;
                });
            });

            // Drag Over
            droppableCells.forEach(cell => {
                cell.addEventListener("dragover", function(event) {
                    event.preventDefault();
                });
            });

            // Drag Enter
            droppableCells.forEach(cell => {
                cell.addEventListener("dragenter", function(event) {
                    event.preventDefault();
                    cell.classList.add("bg-info");
                });
            });

            // Drag Leave
            droppableCells.forEach(cell => {
                cell.addEventListener("dragleave", function(event) {
                    cell.classList.remove("bg-info");
                });
            });


            // Drag Drop
            droppableCells.forEach(cell => {
                cell.addEventListener("drop", function(event) {
                    event.preventDefault();
                    if (draggedModule) {
                        cell.textContent = draggedModule;
                        const day = cell.getAttribute("data-day");
                        const time = cell.getAttribute("data-time");
                        // Stocker les informations dans l'objet emploi_filiere_nomFiliere
                        emploi_filiere_nomFiliere[day + "-" + time] = {
                            moduleId: draggedModule,
                            day: day,
                            time: time,
                            filiere: getFiliere(),
                            semestre: getSemestre(),
                        };

                        // Stocker l'objet dans le stockage local
                        localStorage.setItem("emploi_filiere_" + getFiliere(), JSON.stringify(emploi_filiere_nomFiliere));
                        draggedModule = null;
                    }
                    cell.classList.remove("bg-info");
                });
            });

            // Charger les données depuis le stockage local lors du chargement de la page
            function loadSavedModules() {
                const savedData = localStorage.getItem("emploi_filiere_" + getFiliere());
                if (savedData) {
                    emploi_filiere_nomFiliere = JSON.parse(savedData);
                    // Mettre à jour les cellules avec les données chargées
                    Object.keys(emploi_filiere_nomFiliere).forEach(key => {
                        const moduleInfo = emploi_filiere_nomFiliere[key];
                        const cell = document.querySelector(`.droppable-cell[data-day="${moduleInfo.day}"][data-time="${moduleInfo.time}"]`);
                        if (cell) {
                            cell.textContent = moduleInfo.moduleId;
                        }
                    });
                }
            }

            loadSavedModules();


            // Bouton de réinitialisation
            const resetBtn = document.getElementById("resetBtn");
            resetBtn.addEventListener("click", function() {
                // Effacer les données du stockage local et réinitialiser les cellules
                localStorage.removeItem("emploi_filiere_" + getFiliere());
                emploi_filiere_nomFiliere = {};
                droppableCells.forEach(cell => {
                    cell.textContent = "";
                });
            });
        });
    </script>
</main>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>