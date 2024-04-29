<?php

require_once "../../../../../app/controllers/adminController.php";

use src\app\controllers\adminController;

include_once "../layout.php";

$user = new adminController;

$user->fetchAllCoordinateurs();

$i = 0;

?>
<div class="mt-4 card">
    <div class="card-body">
        <div class="card-title my-4">
            <div class="btn btn-outline-warning">
                <i class="bi bi-person-add text-primary" , style="font-size: 18px;"></i>
                <a class="text-dark font-monospace text-decoration-none" href="./addCord.php">Ajouter Un Coordinateur</a>
            </div>
        </div>
        <table class="table table-bordered border-primary text-center">
            <thead>
                <tr>

                    <th scope="col">NOM</th>
                    <th scope="col">PRENOM</th>
                    <th scope="col">EMAIL_INSTITUTIONNEL</th>
                    <th scope="col">CIN</th>
                    <th scope="col">FILIERES</th>
                    <th scope="col">DEPARTEMENTS</th>
                    <th scope="col">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['coordinateurs'] as $cord) :
                ?>
                    <tr>
                        <td><?= $cord['nom'] ?></td>
                        <td><?= $cord['prenom'] ?></td>
                        <td><?= $cord['email_institutionnel'] ?></td>
                        <td><?= $cord['cin'] ?></td>
                        <td>
                            <?= $cord['filiere'] ?>
                        </td>
                        <td>
                            <?= $cord['departement'] ?>
                        </td>

                        <td>
                            <div class="d-flex">
                                <button class="btn btn-primary me-2">
                                    <a class="text-white text-decoration-none" href="./updateCord.php?cin=<?php echo $cord['cin']; ?>">Modifier</a>
                                </button>
                                <form action="./deleteCord.php" method="POST">
                                    <input type="hidden" name="cin" value="<?= $cord['cin'] ?>">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal<?= $cord['cin'] ?>">
                                        Supprimer
                                    </button>

                                    <!-- Boîte de dialogue de confirmation de suppression -->
                                    <div class="modal fade" id="confirmDeleteModal<?= $cord['cin'] ?>" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer cet coordianteur ?
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