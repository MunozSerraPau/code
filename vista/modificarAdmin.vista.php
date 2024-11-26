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
    <?php require_once BASE_PATH . '/controlador/eliminarUsuari.controlador.php'; ?>
    <?php require_once BASE_PATH . '/controlador/paginacioUsuaris.controlador.php'; ?>

    <?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
    <script>
        function confirmarEliminacion() {
            return confirm('Estas segur que vols eliminar aquest USUARI?');
        }
    </script>

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
    </svg>



    <!-- CODI DE LA WEB -->

    <div class="containerr">
        <?php include BASE_PATH . "/vistaGlobal/nav.vista.php" ?>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <!-- Ventana flotante: usaremos un card de Bootstrap para simular el panel flotante -->
            <!-- Si volem el fosn difuminat hem de ficar en class="bg-transparent" -->
            <div class="card shadow p-4 bg-light" style="max-width: auto; width: 100%; backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid black;">
                <h1 class="text-center text-primary mb-4">Iniciar sessió</h1>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Img Perfil</th>
                                <th scope="col">Usuari</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Cognoms</th>
                                <th scope="col">Correu</th>
                                <th scope="col" class="d-flex justify-content-center">Accions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($llistaUsuaris as $usuari): ?>
                                <tr>
                                    <td><img src="" alt="Imagen de usuario" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;"></td>
                                    <td><?php echo $usuari['nickname']; ?></td>
                                    <td><?php echo $usuari['nom']; ?></td>
                                    <td><?php echo $usuari['cognoms']; ?></td>
                                    <td><?php echo $usuari['correu']; ?></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="<?php echo BASE_URL; ?>/controlador/eliminarUsuari.controlador.php?nickname=<?php echo $usuari['nickname'] ?>&action=delete" class="me-2 btn btn-danger" onclick="return confirmarEliminacion()">
                                            <i class="bi bi-trash3-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>

    </div>


    <!-- Formulario de inicio de sesión -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
