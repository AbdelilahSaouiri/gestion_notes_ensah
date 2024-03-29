<?php

use src\app\controllers\userController;

include_once __DIR__ . "/../../../../vendor/autoload.php";


if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo `<span class="error text-danger">Veuillez réessayer. Connexion échouée</span>`;
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email_inst'];
    $password = $_POST['pwd'];

    if (empty($email)) {
        $errors['empty_email'] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['invalid_email'] = "Invalid email format";
    }
    if (empty($password)) {
        $errors['empty_pwd'] = "Password is required";
    } else if (strlen($password) < 8) {
        $errors['invalid_pwd'] = "Password should be at least 8 characters long";
    }

    if (!array_filter($errors)) {
        $userController = new userController();
        //$userController->login($email, $password);
        $userController->login($_POST['email_inst'], $_POST['pwd']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <h3 class="mt-5 d-flex justify-content-center">Login </h3>
        <div class="row">
            <div class="col-md-6 mx-auto mt-4">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="email_inst" class="form-label">Email Institutionnel*</label>
                        <input type="email_inst" name="email_inst" required class="form-control" id="email_inst" value="<?php echo isset($email) ? $email : '' ?>">
                        <span class=" error text-danger">
                            <?php echo isset($errors['empty_email']) ? $errors['empty_email'] : (isset($errors['invalid_email']) ? $errors['invalid_email'] : "") ?></span>
                    </div>
                    <div class=" mb-4">
                        <label for="pwd" class="form-label">Password*</label>
                        <input type="password" name="pwd" required class="form-control " id="pwd">
                        <span class="error text-danger">
                            <?php echo isset($errors['empty_pwd']) ? $errors['empty_pwd'] : (isset($errors['invalid_pwd']) ? $errors['invalid_pwd'] : "") ?>
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script>

    </script>
</body>

</html>