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
    <?php require_once BASE_PATH . "/controlador/afegirChamp.controlador.php" ?>
    <?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>



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
        

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow p-4 bg-light" style="max-width: 400px; width: 100%; backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid black;">
                <form <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="POST" class="row g-3">
                    <h2 class="text-center text-primary mb-4">Afegir Champion</h2>
                    
                    <div class="col-12">
                        <label for="nomCampio" class="form-label">Nom del Champion</label>
                        <input type="text" class="form-control" id="nomCampio" name="nomCampio" 
                            value="<?php if (isset($_POST['nomCampio'])) { echo $_POST['nomCampio']; } ?>">
                    </div>
                    
                    <div class="col-12">
                        <label for="descripcio" class="form-label">Descripcio</label>
                        <textarea class="form-control" id="descripcio" name="descripcio"><?php if (isset($_POST['descripcio'])) { echo $_POST['descripcio']; } ?></textarea>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="resource" class="form-label">Recurs of Champion</label>
                        <input type="text" class="form-control" id="resource" name="resource" 
                            value="<?php if (isset($_POST['resource'])) { echo $_POST['resource']; } ?>">
                    </div>
                    
                    <div class="col-md-6">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" name="role" class="form-select">
                            <option value="" selected>-----</option>
                            <option value="Marksman">Marksman</option>
                            <option value="Fighter">Fighter</option>
                            <option value="Tank">Tank</option>
                            <option value="Mage">Mage</option>
                            <option value="Assassin">Assassin</option>
                            <option value="Controller">Controller</option>
                            <option value="Specialist">Specialist</option>
                        </select>
                    </div>

                    <!--
                    <div class="col-12">
                        <label for="championImage" class="form-label">Imatge del Champion</label>
                        <input type="file" class="form-control" id="championImage" name="championImage" accept="image/*">
                    </div>
                    -->

                    
                    <?php if (isset($error)): ?>
                        <?php if (!empty($error) && $error != "ChampCreat" && $error != "<br>"): ?>
                            <div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                                    <use xlink:href="#exclamation-triangle-fill"></use>
                                </svg>
                                <div><?php echo $error ?></div>
                            </div>
                        <?php elseif ($error == "ChampCreat"): ?>
                            <?php //header('Location: ../index.php'); ?>
                            <div class="alert alert-success d-flex align-items-center mt-3" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                                    <use xlink:href="#check-circle-fill"></use>
                                </svg>
                                <div>Champion Creat!</div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100" name="insert">Crear Champion</button>
                    </div>
                </form>
            </div>
        </div>


        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>