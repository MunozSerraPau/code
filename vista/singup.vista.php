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

        <div class="container d-flex justify-content-center align-items-center min-vh-100 my-5">
            <!-- Ventana flotante: usaremos un card de Bootstrap para simular el panel flotante -->
            <div class="card shadow p-4 bg-light" style="max-width: 400px; width: 100%; backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid black;">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <h2 class="text-center text-primary mb-4">Crea un compte</h2>

                    <div class="mb-3">
                        <label for="firstname" class="form-label">Nom</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" value="<?php if (isset($_POST['firstname'])) { echo $_POST['firstname']; } ?>">
                    </div>

                    <div class="mb-3">
                        <label for="lastname" class="form-label">Cognoms</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" value="<?php if (isset($_POST['lastname'])) { echo $_POST['lastname']; } ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correu</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>">
                    </div>

                    <div class="mb-3">
                        <label for="nickname" class="form-label">Nom d'Usuari</label>
                        <input type="text" id="nickname" name="nickname" class="form-control" value="<?php if (isset($_POST['nickname'])) { echo $_POST['nickname']; } ?>">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contrasenya</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirmar Contrasenya</label>
                        <input type="password" id="confirm-password" name="confirm-password" class="form-control">
                    </div>

                    <?php if (isset($error)): ?>
                        <?php if (!empty($error) && $error != "S'ha creat Correctament"): ?>
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" style="width: 50px; height: auto;" role="img" aria-label="Danger:">
                                    <use xlink:href="#exclamation-triangle-fill"/>
                                </svg> 
                                <div><?php echo $error; ?></div>
                            </div>
                        <?php elseif ($error === "S'ha creat Correctament"): ?>
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" style="width: 50px; height: auto;" role="img" aria-label="Success:">
                                    <use xlink:href="#check-circle-fill"/>
                                </svg>
                                <div><p>S'ha creat l'Usuari correctament!</p></div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary" name="signup">CREAR COMPTE</button>
                    </div>

                    <p class="text-center">Tens un compte? <a href="<?php echo BASE_URL; ?>/vista/login.vista.php" class="link-primary">Inicia Sessió</a></p>
                </form>
            </div>
        </div>



        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>

    </div>


    <!-- Formulario de inicio de sesión -->
    

    
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>