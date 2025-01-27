<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="./style/style.css">
    <title>LOGIN</title>
</head>
<body>
    <?php require_once '../env.php'; ?>
    <?php require BASE_PATH . "/controlador/editarChamp.controlador.php"; ?>
    <?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
    

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>


    <div class="containerr pt-0">
        <?php include BASE_PATH . "/vistaGlobal/nav.vista.php" ?>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">

        
            <div class="card shadow p-4 bg-light" style="max-width: 400px; width: 100%; backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid #454962;">
                <form <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST" class="row g-3">
                    <div class="col-12">
                        <label for="nomCampio" class="form-label">Nom del Champion</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="nomCampio" 
                            name="nomCampio" 
                            value="<?php echo $champ['name']; ?>">
                    </div>
                    <div class="col-12">
                        <label for="descripcio" class="form-label">Descripció</label>
                        <textarea 
                            class="form-control" 
                            id="descripcio" 
                            name="descripcio"><?php echo $champ['description']; ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="resource" class="form-label">Recurs del Champion</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="resource" 
                            name="resource" 
                            value="<?php echo $champ['resource']; ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="role" class="form-label">Role</label>
                        <select 
                            id="role" 
                            name="role" 
                            class="form-select">
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

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" name="updateChamp">UPDATE Champion</button>
                    </div>
                </form>
            </div>
        </div>

        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>