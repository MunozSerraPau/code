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
    <?php //if (!isset($_SESSION['usuari'])) { header('Location: ' . BASE_URL . '/vista/login.vista.php'); } ?>
    <?php require BASE_PATH . "/controlador/editarEquip.controlador.php"; ?>
    <?php require BASE_PATH . "/controlador/obtenirChampAPI.controlador.php"; ?>

    <div class="containerr pt-0">
        
        <?php include BASE_PATH . "/vistaGlobal/nav.vista.php" ?>
        
        <div class="container d-flex justify-content-center align-items-center min-vh-100">       
            <div class="card shadow p-4 h-100 w-auto bg-transparent" style="backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid #454962;">
                
                <h1 class="text-center text-white">EDITAR EQUIP</h1>

                <?php if($error !== "<br>") { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php } else { ?>
                    <form action="<?= BASE_URL ?>/controlador/editarEquip.controlador.php" method="POST" class="d-flex flex-column justify-content-center align-items-center">
                        
                        <div class="mb-3">
                            <label for="nomEquip" class="form-label text-white">Nom Equip</label>
                            <input type="text" style="width: 300px;" class="form-control" id="nomEquip" name="nomEquip" placeholder="Nom del equip" required>
                        </div>
                        <div class="row d-flex justify-content-center align-items-center">
                            <?php foreach($equip as $campio) { ?>
                                <div class="col col-6 col-md-4 col-lg-3 col-xxl-2 py-3">
                                    <div class="card d-flex justify-content-center align-items-center champion-card bg-ligth" data-id="<?php echo htmlspecialchars($champion['id']); ?>">

                                        <img src="https://ddragon.leagueoflegends.com/cdn/img/champion/loading/<?= substr($campio['imgCampio'], 0, strpos($campio['imgCampio'], '.')) ?>_0.jpg" style="max-width: 100%;" class="px-0" alt="...">
                      
                                        <div class="card-body d-flex flex-column align-items-center w-100">
                                            <h5 class="card-title"><strong><?php echo htmlspecialchars($campio['nameCampio']); ?></strong></h5>
                                            <hr style="height: 3px;" class="w-100 bg-dark opacity-100 my-0" />
                                            <p class="card-text"><?php echo $campio['tagsCampio']; ?></p>
                                        </div>

                                        <select class="form-select" aria-label="Llistat de tots els camps" name="newChampSelect">
                                            <?php foreach($llistatChampions as $champion) { ?>
                                                <option value='<?php echo json_encode($champion); ?>' <?php if ($champion['id'] == $campio['nameCampio']) echo 'selected'; ?>><?php echo htmlspecialchars($champion['id']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <input type="hidden" name="idEquip" value="<?= $idEquip ?>">
                        <button type="submit" class="btn btn-primary">Editar Equip</button>
                    </form>
                <?php }?>
            </div>
        </div>

        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>