<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="ENSAH" />
    <title> Coordinateur</title>
    <link href="../../../utilities/dashboard/static/css/app.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="./home.cordinateur.php" style="margin-left:40px">
                    <i class="bi bi-house-gear"></i>
                    <span class="align-middle">ENSAH</span>
                </a>
                <li class="sidebar-item active">
                    <a class="sidebar-link" href="./home.cordinateur.php">
                        <i class="bi bi-speedometer2"></i>
                        <span class="align-middle">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./gestionModules.php">
                        <i class="align-middle" data-feather="check-square"></i>
                        <span class="align-middle">Gestion de modules</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="#">
                        <i class="align-middle" data-feather="grid"></i>
                        <span class="align-middle">Les Notes Des Etudiants</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="#">
                        <i class="align-middle" data-feather="check-square"></i>
                        <span class="align-middle">La liste Des Etudiants</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./affectationModules.php">
                        <i class="align-middle" data-feather="check-square"></i>
                        <span class="align-middle"> affectation de Modules</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./createEmploi.php">
                        <i class="align-middle" data-feather="check-square"></i>
                        <span class="align-middle"> Créer L'Emploi Du Temps</span>
                    </a>
                </li>
                </ul>

        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="../../../utilities/dashboard/src/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" />
                                <span class="text-dark">
                                    <?php echo isset($_SESSION['nom']) && isset($_SESSION['prenom']) ? strtoupper($_SESSION['nom']) . " " . strtoupper($_SESSION['prenom']) : "" ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="../login.php">
                                    <i class="align-middle me-1" data-feather="user"></i>
                                    Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>