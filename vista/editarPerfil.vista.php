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
    <?php require BASE_PATH . "/controlador/editarUsuari.controlador.php" ?>
    

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
    </svg>


    <div class="containerr">
        <?php include BASE_PATH . "/vistaGlobal/nav.vista.php" ?>
        <div class="container d-flex justify-content-center align-items-center min-vh-100 mt-5 pb-5">
            <!-- Ventana flotante: usaremos un card de Bootstrap para simular el panel flotante -->
            <!-- Si volem el fosn difuminat hem de ficar en class="bg-transparent" -->
            <div class="shadow p-4 bg-light" style="max-width: 400px; width: 100%; backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid #454962;">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <h2 class="text-center text-primary mb-4">Editar Perfil</h2>

                    <div class="d-flex justify-content-center mb-4">
                        <img src="<?php echo BASE_URL . $usuariInfo['imgPerfil']; ?>" alt="Imagen de perfil" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover; border: 3px solid #454962;">
                    </div>

                    <div class="mb-3">
                        <label for="firstname" class="form-label">Nom</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo $usuariInfo['nom']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="lastname" class="form-label">Cognoms</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo $usuariInfo['cognoms']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correu</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo $usuariInfo['correu']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="nickname" class="form-label">Nom d'Usuari</label>
                        <input type="text" id="nickname" name="nickname" disabled class="form-control" value="<?php echo $usuariInfo['nickname']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="userImg" class="form-label">Img Perfil</label>
                        <input type="file" class="form-control" id="userImg" name="userImg" accept="image/*">
                    </div>

                    <?php if (isset($error)): ?>
                        <?php if (!empty($error) && $error != "Usuari ACTUALITZAT CORRECTAMENT!" && $error != "ATENCIO, no s'ha fet cap canvi!" && $error != "<br>"): ?>
                            <div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                                    <use xlink:href="#exclamation-triangle-fill"></use>
                                </svg>
                                <div><?php echo $error ?></div>
                            </div>
                        <?php elseif ($error == "ATENCIO, no s'ha fet cap canvi!"): ?>
                            <div class="alert alert-warning d-flex align-items-center mt-3" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                                    <use xlink:href="#exclamation-triangle-fill"></use>
                                </svg>
                                <div>ATENCIO, no s'ha fet cap canvi!</div>
                            </div>
                        <?php elseif ($error == "Usuari ACTUALITZAT CORRECTAMENT!"): ?>
                            <div class="alert alert-success d-flex align-items-center mt-3" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                                    <use xlink:href="#check-circle-fill"></use>
                                </svg>
                                <div>Perfil Actualitzat!</div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary" name="updateUsuari">EDITAR PERFIL</button>
                    </div>

                </form>
            
            </div>
        </div>


        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>

    </div>


    <!-- Formulario de inicio de sesión -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
