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
    <link rel="icon" href="../../utilities/img/logo-ensah.png">
    <title>HOME PAGE</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background: url(../../utilities/img/bg.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }

        .rounded-input {
            border-radius: 12px;
        }

        .btn-color {
            background-color: green;
        }

        .pad {
            padding: 14px 15px;
        }

        .bg-css {
            background-color: #fff;
        }

        input::placeholder {
            color: orange;
        }
    </style>
</head>

<body>
    <div class="container mt-5 ">
        <div class="row">
            <div class="col-md-5 mt-5 ms-auto  p-0">
                <img src="../../utilities/img/ensah.jpeg" class="img-thumbnail p-0 h-100 " alt="ensah">
            </div>
            <div class="col-md-4 me-auto mt-5 bg-css">
                <span class="mt-4 btn fs-4 text-info w-100" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;"> Login</span>
                <form action="" method="post" class=" mb-5 text-center ">
                    <div class="mb-4">
                        <label for="email_inst" class="form-label my-3 ms-3 text-primary">Email Institutionnel *</label>
                        <input type="email_inst" placeholder="Email Institutionnel" name="email_inst" required class="form-control rounded-input pad" id="email_inst" value="<?php echo isset($email) ? $email : '' ?>">
                        <span class=" error text-danger">
                            <?php echo isset($errors['empty_email']) ? $errors['empty_email'] : (isset($errors['invalid_email']) ? $errors['invalid_email'] : "") ?></span>
                    </div>
                    <div class=" mb-4">
                        <label for="pwd" class="form-label ms-3 text-primary">Password *</label>
                        <input type="password" name="pwd" placeholder="Password" required class="form-control rounded-input pad" id="pwd">
                        <span class="error text-danger">
                            <?php echo isset($errors['empty_pwd']) ? $errors['empty_pwd'] : (isset($errors['invalid_pwd']) ? $errors['invalid_pwd'] : "") ?>
                        </span>
                    </div>
                    <div class="p-3  text-center">
                        <button type="submit" class="btn text-white btn-color w-100 mt-3" style="border-radius: 7px;">Se Connecter</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
