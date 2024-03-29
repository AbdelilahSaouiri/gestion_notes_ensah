   <?php session_start(); ?>

   <!DOCTYPE html>
   <html lang="en" dir="ltr">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
       <title><?php echo $title ?></title>
   </head>

   <body>
       <div class="container">
           <div class="mt-5 fs-4">
               <i class="bi bi-briefcase" style="color:blue"></i>
               Bienvenu <?php echo '<span class="text-primary fs-4">' . strtoupper($_SESSION['nom']) . ' ' . strtoupper($_SESSION['prenom']) . '</span>'; ?> Dans l'espace E-ENSAH
           </div>
           <div class="mt-5 d-grid gap-2 col-auto mt-3">
               <a href="./home.cordinateur.php" class="text-decoration-none d-flex align-items-center">
                   <i class="bi bi-house-door" style="font-size: 20px;"></i>
                   <h6 class=" mt-2 ms-2">Acceuil</h6>
               </a>
           </div>