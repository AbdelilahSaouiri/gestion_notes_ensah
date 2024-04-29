<?php

require_once "../../../../../app/controllers/adminController.php";

use src\app\controllers\adminController;

include_once "../layout.php";

$user = new adminController;

$user->fetchAllchefDepartement();


?>
<div class="mt-4 card">
    <div class="card-body">
        <div class="card-title my-4">
            <div class="btn btn-outline-warning">
                <i class="bi bi-person-add text-primary" , style="font-size: 18px;"></i>
                <a class="text-dark font-monospace text-decoration-none" href="./addChefDep.php">Ajouter Un Chef de Departement</a>
            </div>
        </div>
        <table class="table table-bordered border-primary text-center">
            <thead>
                <tr>

                    <th scope="col">NOM</th>
                    <th scope="col">PRENOM</th>
                    <th scope="col">EMAIL_INSTITUTIONNEL</th>
                    <th scope="col">CIN</th>
                    <th scope="col">DEPARTEMENT</th>
                    <th scope="col">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['chef_departements'] as $chef_dep) :
                ?>
                    <tr>
                        <td><?= $chef_dep['nom'] ?></td>
                        <td><?= $chef_dep['prenom'] ?></td>
                        <td><?= $chef_dep['email_institutionnel'] ?></td>
                        <td><?= $chef_dep['cin'] ?></td>
                        <td><?= $user->fetchNomDepartement($chef_dep['cin']) ?></td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-primary me-2">
                                    <a class="text-white text-decoration-none" href="./updateChef.php?cin=<?php echo $chef_dep['cin']; ?>">Modifier</a>
                                </button>
                                <form action="./deleteChefDep.php" method="POST">
                                    <input type="hidden" name="cin" value="<?= $chef_dep['cin'] ?>">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal<?= $chef_dep['cin'] ?>">
                                        Supprimer
                                    </button>

                                    <!-- Boîte de dialogue de confirmation de suppression -->
                                    <div class="modal fade" id="confirmDeleteModal<?= $chef_dep['cin'] ?>" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer ce chef de departement ?
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