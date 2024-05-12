<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="ENSAH" />
    <title>Dashboard</title>
    <link href="../../../utilities/dashboard/static/css/app.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: medium;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="./home.chef_dep.php" style="margin-left:40px">
                    <span class="align-middle">ENSAH</span>
                </a>
                <li class="sidebar-item active">
                    <a class="sidebar-link" href="./home.chef_dep.php">
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
                    <a class="sidebar-link" href="./gestionprof.php">
                        <i class="align-middle" data-feather="grid"></i>
                        <span class="align-middle">Gestion de Professeurs</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./prof_f.php">
                        <i class=" align-middle" data-feather="check-square"></i>
                        <span class="align-middle">Affectation Des Modules</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./consulterArchive.php">
                        <i class="bi bi-archive"></i>
                        <span class="align-middle">Consulter Archive</span>
                    </a>
                </li>
                </ul>
        </nav>
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg ">
                <a class="sidebar-toggle js-sidebar-toggle ">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="bell"></i>
                                <span class="indicator  me-2">4</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="../../../utilities/dashboard/src/img/avatars/Unknown_person.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" />
                                <span class="text-dark">
                                    <?= isset($_SESSION['nom']) && isset($_SESSION['prenom']) ? strtoupper($_SESSION['nom']) . " " . strtoupper($_SESSION['prenom']) : "" ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="../login.php">
                                    <i class="align-middle me-1" data-feather="user"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>