<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./style/style.css">
    <title>LLISTAT EQUIPS</title>
</head>

<body>
    <?php require_once '../env.php'; ?>
    <?php require_once BASE_PATH . '/controlador/llistatEquips.controlador.php'; ?>
    <?php // require_once BASE_PATH . '/controlador/eliminarEquips.controlador.php'; ?>
    <?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
    <script>
        function confirmarEliminacion() {
            return confirm('Estas segur que vols eliminar aquest campió?');
        }
    </script>


    <div class="containerr pt-0">

        <?php include BASE_PATH . "/vistaGlobal/nav.vista.php" ?>

        <div class="container-lg d-flex justify-content-center align-items-center min-vh-100">
            <div class="container shadow p-4 bg-transparent d-flex flex-column" style="backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid #454962;">

                <h1 class="text-center text-white">LLISTAT EQUIPS</h1>

                <form action="<?php echo BASE_URL; ?>/controlador/comprovacioQr.controlador.php" method="post" enctype="multipart/form-data" class="mb-4 d-flex flex-column align-items-center">
                    <div class="mb-3 d-flex flex-column align-items-center">
                        <label for="archivoQR" class="form-label text-white">Lectura de Qr:</label>
                        <input type="file" class="form-control w-50" id="archivoQR" name="archivoQR" required>
                    </div>
                    <button name="pujarQR" type="submit" class="btn btn-primary">Subir</button>
                </form>
                
                <?php if (empty($equipos)): ?>
                    <p>No hay equipos disponibles.</p>
                <?php else: ?>
                    <?php foreach ($equipos as $nombreEquipo => $datosEquipo): ?>
                        <? //var_dump($datosEquipo) ?>
                        <div class="row my-4">
                            <div class="col-10 bg-light p-3 rounded-3">
                                <div class="row align-items-center">
                                    <div class="col-3 border-end h-100">
                                        <h2 class="h3 text-triary fw-bold text-center"><?= htmlspecialchars($nombreEquipo) ?></h2>
                                    </div>

                                    <div class="col">
                                        <div class="row row-cols-1 row-cols-md-5 row-cols-lg-6">
                                            <?php foreach ($datosEquipo['campeones'] as $campeon): ?>
                                                <div class="col text-center my-auto">
                                                    <p class="mb-0"><?= htmlspecialchars($campeon['nombre']) ?></p>
                                                    <hr class="my-0" />
                                                    <p class="mb-0"><?= htmlspecialchars($campeon['tags']) ?></p>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="col">
                                                <img src="<?= htmlspecialchars($datosEquipo['qr']) ?>" alt="QR del equipo" style="max-width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-2 d-grid">
                                <div class="d-flex flex-column flex-md-row align-items-center justify-content-center align-content-center">
                                    <?php if (isset($nomUsuari) && $nomUsuari === $datosEquipo['creator']): ?>
                                        <a href="<?php echo BASE_URL; ?>/controlador/eliminarEquip.controlador.php?id=<?php echo htmlspecialchars($datosEquipo['id']) ?>&action=delete" class="me-2 btn btn-outline-danger mb-3 mb-md-0" onclick="return confirmarEliminacion()">
                                            <i class="bi bi-trash3-fill"></i>
                                        </a>
                                    <?php endif; ?>

                                    <a href="<?php echo BASE_URL; ?>/vista/editarChamp.vista.php?idChampEditar=<?php echo htmlspecialchars($datosEquipo['id']) ?>" class="me-2 btn btn-outline-primary mb-3 mb-md-0">
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <script>
                                        $('a[download]').each(function() {
                                            var $a = $(this),
                                                fileUrl = $a.attr('href');
                                            $a.attr('href', 'data:application/octet-stream,' + encodeURIComponent(fileUrl));
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php endif; ?>

            </div>
        </div>

        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>