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
        
        


        <div class="container d-flex justify-content-center min-vh-100" style="padding-top: 10rem; padding-bottom: 5rem;">
            
            <div class="shadow p-4 bg-light container" style="border-radius: 25px; border: 3px solid #454962;">

            
                <h1 class="text-center mb-4">Crear Equip</h1>    
                    
                <form id="championForm" action="process.php" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST" class="d-flex flex-column align-items-center">
                    <label for="nomEquip" class="form-label">Nom de l'equip: </label>
                    <input type="text" id="nomEquip" name="nomEquip" class="form-control" required>
                    
                    <div class="row">
                        <div class="col" id="champEscollit_1">
                            
                        </div>
                        <div class="col" id="champEscollit_2">
                            
                        </div>
                        <div class="col" id="champEscollit_3">
                            
                        </div>
                        <div class="col" id="champEscollit_4">
                            
                        </div>
                        <div class="col" id="champEscollit_5">
                            
                        </div>
                    </div>

                    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 ">
                        <?php foreach ($llistatChampions as $champion) : ?>
                            <div class="col py-3">
                                <div class="card">
                                    <img src="https://ddragon.leagueoflegends.com/cdn/15.1.1/img/champion/<?php echo $champion['img']; ?>" class="card-img-top rounded-circle p-2" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><strong><?php echo htmlspecialchars($champion['id']); ?></strong></h5>
                                        <p class="card-text"><?php echo $champion['tags']; ?></p>
                                        <label>
                                            <input type="checkbox" name="champions[]" value="<?php echo htmlspecialchars($champion['id']); ?>">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

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