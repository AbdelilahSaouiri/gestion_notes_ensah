<?php

require_once "../../../../../app/controllers/adminController.php";

use src\app\controllers\adminController;

include_once "../layout.php";

$user = new adminController;

$user->fetchAllteachers();
$user->fetchDepartementforTeach();


?>
<div class="mt-4 card">
    <div class="card-body">
        <div class="card-title my-4">
            <div class="btn btn-outline-warning">
                <i class="bi bi-person-add text-primary" , style="font-size: 18px;"></i>
                <a class="text-dark font-monospace text-decoration-none" href="./addprof.php">Ajouter Un professeur</a>
            </div>
        </div>
        <table class="table table-bordered border-primary text-center">
            <thead>
                <tr>
                    <th scope="col">CIN</th>
                    <th scope="col">NOM</th>
                    <th scope="col">PRENOM</th>
                    <th scope="col">EMAIL_INSTITUTIONNEL</th>
                    <th scope="col">DEPARTEMENT</th>
                    <th scope="col">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['profs'] as $prof) : ?>
                    <tr>
                        <td><?= $prof['cin'] ?></td>
                        <td><?= $prof['nom'] ?></td>
                        <td><?= $prof['prenom'] ?></td>
                        <td><?= $prof['email_isntitutionnel'] ?></td>
                        <td><?= $_SESSION['departement']['nom_dep'] ?></td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-primary me-2">
                                    <a class="text-white text-decoration-none" href="./updateProf.php?cin=<?= $prof['cin'] ?>">Modifier</a>
                                </button>
                                <form action="./deleteprof.php" method="POST">
                                    <input type="hidden" name="cin" value="<?= $prof['cin'] ?>">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal<?= $prof['cin'] ?>">
                                        Supprimer
                                    </button>

                                    <!-- Boîte de dialogue de confirmation de suppression -->
                                    <div class="modal fade" id="confirmDeleteModal<?= $prof['cin'] ?>" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer cet etudiant ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once "../../footer.php" ?>