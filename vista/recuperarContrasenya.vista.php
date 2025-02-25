<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./style/style.css">
    <title>RECUPERAR CONTRASENYA</title>
</head>
<body>
    <?php require_once '../env.php'; ?>
    <?php require_once BASE_PATH . "/controlador/recuperarContrasenya.controlador.php" ?>
    <?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
    </svg>

    <div class="position-absolute top-0 start-0" style="z-index: 9999;">
        <a href="#main-content" class="btn btn-primary btn-Tabular fw-bold">Ir al contenido principal</a>
    </div>

    <div class="containerr min-vh-100 d-flex flex-column justify-content-between">
        <?php include BASE_PATH . "/vistaGlobal/nav.vista.php" ?>
        <div class="container d-flex justify-content-center align-items-center " id="main-content">
            <!-- Ventana flotante: usaremos un card de Bootstrap para simular el panel flotante -->
            <!-- Si volem el fosn difuminat hem de ficar en class="bg-transparent" -->
            <div class="card shadow p-4 bg-light" style="max-width: 400px; width: 100%; backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid #454962;">
                <form <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST" class="login-form">
                    <h2>Recuperar Contrasenya</h2>
                    <br>

                    <!-- Repetir Contrasenya -->
                    <div class="mb-3">
                        <label for="correuRecuperacio" class="form-label">Correu:</label>
                        <input type="email" id="correuRecuperacio" name="correuRecuperacio" class="form-control" required>
                    </div>

                    <!-- Mostrar Missatges -->
                    <?php if (isset($error)): ?>
                        <?php if (!empty($error) && $error != "CorreuEnviat" && $error != "<br>"): ?>
                            <div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                                    <use xlink:href="#exclamation-triangle-fill"></use>
                                </svg>
                                <div><?php echo $error ?></div>
                            </div>
                        <?php elseif ($error == "CorreuEnviat"): ?>
                            <div class="alert alert-success d-flex align-items-center mt-3" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                                    <use xlink:href="#check-circle-fill"></use>
                                </svg>
                                <div>Correu enviat!</div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Botó Actualitzar -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" name="enviarCorreu">Actualitzar Contrasenyas</button>
                    </div>
                </form>
            </div>
        </div>


        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>

    </div>


    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("correuRecuperacio").focus();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
