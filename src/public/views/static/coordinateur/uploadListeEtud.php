<?php
session_start();
include_once "../../../../app/controllers/coordinateurController.php";

use src\app\controllers\coordinateurController;

$user = new coordinateurController;

$cin_cord = isset($_SESSION['cin_cord']) ? $_SESSION['cin_cord'] : "";
$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
?>
<?php include_once "./masterPage.php"  ?>

<main>
    <div class="container">
        <div>
            <div class="w-50 mx-auto mt-3 fs-4 text-center " style="background-color:#183258;border-radius: 10px;">
                <span class="d-block text-white py-2"><span class="me-1 text-capitalize" style="letter-spacing: 1px;font-size:18px;">Fournir La liste Des étudiants </span>
                    <span class="d-block text-white py-2"><span class="me-1 text-capitalize" style="letter-spacing: 1px;font-size:18px;">filière</span>: <?= $filiere ?> </span>
            </div>
        </div>
        <?php include_once "./uploadFile.php";  ?>
    </div>
</main>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>