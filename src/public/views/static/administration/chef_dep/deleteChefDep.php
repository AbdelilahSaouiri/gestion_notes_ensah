<?php include_once "../layout.php"; ?>

<?php

use src\app\controllers\adminController;


require_once "../../../../../app/controllers/adminController.php";

$user = new adminController;

$errors = [];

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$cin = isset($_POST['cin']) ? $_POST['cin'] : "";

$user->deleteChefDepartement($cin);
header("Location:./chef_dep.php");

?>
