<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style/reset.css">
    <link rel="stylesheet" href="../style/style.css">
    <title>Crear Equip</title>
</head>
<body>
    <?php require_once '../env.php'; ?>
    <?php require BASE_PATH . '/controlador/crearEquips.controlador.php'; ?>
    <?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>

    <div class="containerr pt-0">
        <?php include BASE_PATH . "/vistaGlobal/nav.vista.php" ?>
        
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow p-4 bg-light" style="max-width: 400px; width: 100%; backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid #454962;">
            <h1 class="text-center mb-4">Crear Equip</h1>    
                
            <form id="championForm" action="process.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST" class="row g-3">
                <label for="nomEquip" class="form-label">Nom de l'equip: </label>
                <input type="text" id="nomEquip" name="nomEquip" class="form-control" required>

                
                <button class="btn btn-primary" type="submit" name="crearEquip">
                    Crear Equip
                </button>
            </form>
            </div>
        </div>

        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>