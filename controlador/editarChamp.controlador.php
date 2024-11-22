<?php
    // Pau Muñoz Serra


    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    require_once BASE_PATH . "/model/editarChamp.model.php";
    require_once BASE_PATH . "/controlador/connexio.php";
    $connexio = connexio();

    $champ;


    // Verificar que l'Usuari estigui loguejat
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateChamp'])) {
        $idChampion = trim(htmlspecialchars($_GET['idChampEditar']));
        $name = htmlspecialchars($_POST['nomCampio']);
        $description = htmlspecialchars($_POST['descripcio']);
        $recurce = htmlspecialchars($_POST['resource']);
        $role = htmlspecialchars($_POST['role']);
        $nomUsuari = $_SESSION['usuari']; // Usuario actual desde la sesión
        

        if (modelComprovarChampNickname($connexio, $idChampion, $nomUsuari) === "LaCreatEll") {
            if(modelModificarCampion($connexio, $name, $description, $recurce, $role, $idChampion) === "Actualitzat") {
                echo '<script> alert("Champ actualitzat correctament"); window.location.href = "../index.php"; </script>';
            } else {
                echo '<script> alert("Error al actualitzar el campió"); window.location.href = "../index.php"; </script>';
            }
        } else {
            // Denegar l'acceso i mostrar un missatge d'error
            echo '<script> alert("Error NO tens permisos per editar aquest campió"); window.location.href = "../index.php"; </script>';
            exit();
        }
    } else if (isset($_GET['idChampEditar'])) {
        $idChampion = trim(htmlspecialchars($_GET['idChampEditar']));
        $nomUsuari = $_SESSION['usuari']; // Usuari actual desde la sesión

        if (modelComprovarChampNickname($connexio, $idChampion, $nomUsuari) === "LaCreatEll") {
            echo "grrrrrrrrrrrrrrrrrrrr";
            $champ = modelObtenirChamp($connexio, $idChampion);
            echo $champ;
        } else {
            echo '<script> alert("Error NO tens permisos per editar aquest campió"); window.location.href = "../index.php"; </script>';
            exit();
        }
    }
?>