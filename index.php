<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
    <?php require_once './env.php'; ?>
    <?php
        if(isset($_SESSION['usuari'])) {
            $nomUsuari = $_SESSION['usuari'];
            echo "HOLAAAAA" . $nomUsuari;
        }
    ?>

    
    <div class="containerr">
        <?php include BASE_PATH . "/vistaGlobal/nav.vista.php" ?>

        <div class="container floating-panel">
            <h1 class="text-white text-center"> INDEX </h1>
            <?php include BASE_PATH . "/vistaGlobal/mostrararticles.vista.php" ?>
        </div>

        

        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>

    </div>




    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>