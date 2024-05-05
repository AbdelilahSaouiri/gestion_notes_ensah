<?php
session_start();
include_once "../../../../app/controllers/chefDepartementController.php";

use src\app\controllers\chefDepartementController;

$user = new chefDepartementController;

$cin = isset($_GET['cin']) ? $_GET['cin'] : "";
$deleted = $user->deleteProfesseur($cin);
?>

<?php include "./masterPage.php" ?>
<?php if ($deleted == true) : ?>
    <script>
        alert("le professeur a été avec succés ");
        window.location.href = './gestionprof.php';
    </script>

<?php endif; ?>

<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>