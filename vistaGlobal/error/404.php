<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../style/reset.css">
    <link rel="stylesheet" href="../../style/style.css">
    <title>404</title>
</head>
<body>
    <?php require_once '../../env.php'; ?>


    <div class="containerr">
        <?php include BASE_PATH . "/vistaGlobal/nav.vista.php" ?>
        <div class="container d-flex justify-content-center align-items-center ">
            
            <div class="card shadow p-4 bg-light" style="max-width: 400px; width: 100%; backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid #454962;">
                <h2>404</h2>
                <br>

                <div class="form-group text-center">
                    <a type="button" class="btn btn-primary" href="<?php echo BASE_URL ?>/index.php">Actualitzar Contrasenyas</a>
                </div>
            </div>
        </div>


        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>

    </div>


    <!-- Formulario de inicio de sesión -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
