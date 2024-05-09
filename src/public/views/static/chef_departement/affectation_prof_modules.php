<?php
session_start();
include_once "../../../../app/controllers/chefDepartementController.php";
include_once "../../../../app/controllers/RestController.php";

use src\app\controllers\chefDepartementController;
use src\app\controllers\RestController;

$restcontroller = new RestController;
$user = new chefDepartementController;
$Currentfiliere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$cin = isset($_SESSION['chef_cin']) ? $_SESSION['chef_cin'] : "";
$departement = $user->getDepartement($cin);
$modules1 = $user->getmodules($Currentfiliere, 1);
$modules2 = $user->getmodules($Currentfiliere, 2);
$departement = $user->getDepartement($cin);
$profsDepartement = $user->getProfsSelonDepartement($departement['id_departement']);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $modulesDataJson = $_POST['modulesData'];

    $modulesData = json_decode($modulesDataJson, true);

    // Supprimer les doublons en utilisant array_unique avec l'option SORT_REGULAR
    $indexedModulesData = array_values($modulesData);
    $uniqueModulesData = array_unique($indexedModulesData, SORT_REGULAR);

    // Convertir le tableau multidimensionnel indexé en tableau associatif avec les clés réindexées
    $uniqueModulesDataAssociative = array_combine(range(0, count($uniqueModulesData) - 1), $uniqueModulesData);

    $restcontroller->affecterModuleProf($uniqueModulesData, $departement['id_departement']);
}

?>

<?php include "./masterPage.php" ?>

<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Département: <span class="text-primary"><?= isset($departement["nom_dep"]) ? $departement["nom_dep"] : "" ?></span></h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Filière: <span class="text-primary"><?= $Currentfiliere ?></span></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="btn-group " role="group" aria-label="Semesters">
                    <button id="api" type="button" class="btn btn-secondary semester-button mx-2" data-semester="1">Semestre 1</button>
                    <button type="button" class="btn btn-secondary semester-button" data-semester="2">Semestre 2</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <h2>Professeurs</h2>
                <?php foreach ($profsDepartement as $prof) : ?>
                    <button class="btn btn-warning draggable prof my-2 w-75" draggable="true" data-prof-id="<?= $prof['nom'] . ' ' . $prof['prenom'] ?>">
                        <?= $prof['nom'] ?> <?= $prof['prenom'] ?>
                    </button>
                <?php endforeach; ?>
            </div>
            <div class="col-sm-10">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Module</th>
                            <th>Professeur de Cours</th>
                            <th>Professeur de TD/TP</th>
                        </tr>
                    </thead>
                    <tbody id="module-table-body">
                        <?php foreach ($modules1 as $md1) : ?>
                            <tr class="droppable" data-module-id="<?= $md1['nom_modules'] ?>">
                                <td><?= $md1['nom_modules']; ?></td>
                                <td class="course-cell droppable"></td>
                                <td class="tdtp-cell droppable"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center gap-1">
                    <button class="btn btn-primary  w-25" id="submitBtn" type="button">Submit</button>
                    <button class="btn btn-primary  w-25" type="reset" onclick="resetValues()">Reset</button>
                </div>
            </div>
        </div>
    </div>
</main>
<form id="dataForm" method="post" action="">
    <input type="hidden" name="modulesData" id="modulesDataInput" />
    <button type="submit" style="display: none;">Soumettre</button>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modulesData = JSON.parse(localStorage.getItem("modulesData"));
        document.getElementById("modulesDataInput").value =
            JSON.stringify(modulesData);
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const semesterButtons = document.querySelectorAll('.semester-button');
        const moduleTableBody = document.getElementById('module-table-body');
        const draggableItems = document.querySelectorAll('.draggable');
        const droppableItems = document.querySelectorAll('.droppable');

        // Fonction pour gérer le début du glisser-déposer
        function handleDragStart(e) {
            e.dataTransfer.setData('text/plain', e.target.dataset.profId);
        }

        // Fonction pour gérer le survol
        function handleDragOver(e) {
            e.preventDefault();
        }

        // Fonction pour gérer le dépôt d'un élément
        function handleDrop(e) {
            e.preventDefault();
            const data = e.dataTransfer.getData('text/plain');
            const profName = data.split(' ');
            const profFullName = profName[0] + ' ' + profName[1];

            if (e.target.classList.contains('droppable')) {
                // Stocker le nom et prénom du professeur dans un attribut personnalisé de la cellule
                e.target.dataset.profName = profFullName;
                // Afficher le nom complet du professeur dans la cellule
                e.target.innerText = profFullName;
            }
        }

        // Fonction pour récupérer les données des modules avec les professeurs sélectionnés
        function getModulesWithProfessors() {
            const modulesData = [];
            droppableItems.forEach(item => {
                const moduleId = item.closest('tr').dataset.moduleId;
                const moduleName = item.closest('tr').querySelector('td:first-child').textContent;
                const courseProf = item.closest('tr').querySelector('.course-cell').dataset.profName || '';
                const tdtpProf = item.closest('tr').querySelector('.tdtp-cell').dataset.profName || '';

                modulesData.push({
                    id: moduleId,
                    nom_module: moduleName,
                    course_prof: courseProf,
                    tdtp_prof: tdtpProf
                });
            });
            return modulesData;
        }

        // Gestionnaire d'événements pour le bouton "Submit"
        const submitButton = document.getElementById('submitBtn');
        submitButton.addEventListener('click', function() {
            const modulesWithProfessors = getModulesWithProfessors();
            // Stocker les données dans le localStorage
            localStorage.setItem('modulesData', JSON.stringify(modulesWithProfessors));
            // Soumettre le formulaire
            document.getElementById('dataForm').submit();
        });

        // Fonction pour charger les données depuis le localStorage lors du chargement de la page
        function loadModulesDataFromLocalStorage() {
            const modulesData = JSON.parse(localStorage.getItem('modulesData'));
            if (modulesData && Array.isArray(modulesData)) {
                modulesData.forEach(module => {
                    const moduleId = module.id;
                    const courseProfCell = document.querySelector(`[data-module-id="${moduleId}"] .course-cell`);
                    const tdtpProfCell = document.querySelector(`[data-module-id="${moduleId}"] .tdtp-cell`);
                    if (courseProfCell && tdtpProfCell) {
                        courseProfCell.dataset.profName = module.course_prof;
                        courseProfCell.innerText = module.course_prof;
                        tdtpProfCell.dataset.profName = module.tdtp_prof;
                        tdtpProfCell.innerText = module.tdtp_prof;
                    }
                });
            }
        }

        // Charger les données depuis le localStorage lors du chargement de la page
        loadModulesDataFromLocalStorage();

        // Ajouter les écouteurs d'événements pour le glisser-déposer
        draggableItems.forEach(item => {
            item.addEventListener('dragstart', handleDragStart);
        });

        droppableItems.forEach(item => {
            item.addEventListener('dragover', handleDragOver);
            item.addEventListener('drop', handleDrop);
        });

        // Gestionnaire d'événements pour les boutons de semestre
        semesterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const semester = this.dataset.semester;
                const modules = semester === '1' ? <?= json_encode($modules1) ?> : <?= json_encode($modules2) ?>;
                moduleTableBody.innerHTML = '';

                modules.forEach(module => {
                    const moduleRow = document.createElement('tr');
                    moduleRow.classList.add('droppable');
                    moduleRow.dataset.moduleId = module.id;

                    const moduleNameCell = document.createElement('td');
                    moduleNameCell.textContent = module.nom_modules;
                    moduleRow.appendChild(moduleNameCell);

                    const courseProfCell = document.createElement('td');
                    courseProfCell.classList.add('course-cell', 'droppable');
                    moduleRow.appendChild(courseProfCell);

                    const tdtpProfCell = document.createElement('td');
                    tdtpProfCell.classList.add('tdtp-cell', 'droppable');
                    moduleRow.appendChild(tdtpProfCell);

                    moduleTableBody.appendChild(moduleRow);
                });
            });
        });
    });

    function resetValues() {
        document.location.reload();
        localStorage.removeItem('modulesData');
    }
</script>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>