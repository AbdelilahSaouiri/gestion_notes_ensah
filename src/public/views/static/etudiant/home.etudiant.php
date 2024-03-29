<?php

$title = "Dashboard Etudiant";

include_once "../../layout.php";

session_start();
?>
<title><?php echo $title ?></title>
</head>

<body>
    <div class="container-sm">
        <div class="mt-5 fs-4">
            <i class="bi bi-briefcase" style="color:blue"></i>
            Bienvenu <?php echo '<span class="text-primary fs-4">' . strtoupper($_SESSION['etud_nom']) . ' ' . strtoupper($_SESSION['etud_prenom']) . '</span>'; ?> Dans l'espace p-services
        </div>
        <div class="mt-5 d-grid gap-2 col-auto mt-3">
            <a href="./home.etudiant.php" class="text-decoration-none d-flex align-items-center">
                <i class="bi bi-house-door" style="font-size: 20px;"></i>
                <h6 class=" mt-2 ms-2">Acceuil</h6>
            </a>

        </div>

        <div class="mt-4 d-flex justify-content-between  ">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="btn btn-primary  mb-4 w-25"><i class="bi bi-clipboard me-5"></i>Consulter les notes </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="btn btn-primary w-25 mb-4"><i class="bi bi-calendar2-event me-3"></i>Consulter l'emploi du temps</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="btn btn-primary w-25 mb-4"><i class="bi bi-archive me-3"></i> Consulter Archive des notes</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-2 d-grid gap-2 col-auto mt-3">
            <a href="../login.php" class="text-decoration-none d-flex align-items-center">
                <i class="bi bi-box-arrow-right" style="font-size: 20px;"></i>
                <h6 class=" mt-2 ms-2">Se déconnecter</h6>
            </a>

        </div>





    </div>
</body>

</html>