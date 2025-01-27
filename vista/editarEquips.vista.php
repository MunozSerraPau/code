<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="./style/style.css">
    <title>EDITAR EQUIP</title>
</head>
<body>
    <?php require_once '../env.php'; ?>
    <?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
    

    <div class="containerr pt-0">
        
        <?php include BASE_PATH . "/vistaGlobal/nav.vista.php" ?>
        
        <div class="container d-flex justify-content-center align-items-center min-vh-100">       
            <div class="card shadow p-4 bg-light" style="max-width: 400px; width: 100%; backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid #454962;">
                
                <h1 class="text-center text-white">EDITAR EQUIP</h1>


                
            </div>
        </div>

        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>