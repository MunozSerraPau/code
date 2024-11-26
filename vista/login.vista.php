<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style/reset.css">
    <link rel="stylesheet" href="../style/style.css">
    <title>LOGIN</title>
</head>
<body>
    <?php require_once '../env.php'; ?>
    <?php require_once BASE_PATH . "/controlador/usuaris.controlador.php" ?>
    <?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
    


    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>



    <div class="containerr">
        <?php include BASE_PATH . "/vistaGlobal/nav.vista.php" ?>

        
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <!-- Ventana flotante: usaremos un card de Bootstrap para simular el panel flotante -->
            <!-- Si volem el fosn difuminat hem de ficar en class="bg-transparent" -->
            <div class="card shadow p-4 bg-light" style="max-width: 400px; width: 100%; backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid #454962;">
                <form <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>, method="POST">
                    <h1 class="text-center mb-4">Iniciar sessió</h1>
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuari</label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            class="form-control" 
                            value="<?php if (isset($_POST['username'])) { echo $_POST['username']; } ?>">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contrasenya</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="recordam" class="form-check-input" id="recordam">
                        <label class="form-check-label" for="recordam">Recorda'm</label>
                    </div>

                    <div class="mb-3">
                        <p class="form-text">Has oblidat la contrasenya? <a href="<?php echo BASE_URL; ?>/vista/canviarContrasenya.vista.php" class="link-primary">Recuperar  </a></p>
                    </div>

                    <?php if (isset($error)): ?>
                        <!-- Mirar si va -->
                        
                        <?php if (!empty($error) && $error != "UsuariConnectat"): ?>
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                <div><?php echo $error; ?></div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary" name="login">Iniciar sesión</button>
                    </div>

                    <p class="text-center">No tens un compte? <a href="<?php echo BASE_URL; ?>/vista/singup.vista.php" class="link-primary">Registra't</a></p>
                </form>
            </div>
        </div>


        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>

    </div>


    <!-- Formulario de inicio de sesión -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>