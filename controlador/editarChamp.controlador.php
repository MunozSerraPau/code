<?php
    // Pau Muñoz Serra
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require_once BASE_PATH . "/model/editarChamp.model.php";


    // Verificar que l'Usuari estigui loguejat
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateChamp'])) {
        $idChampion = trim(htmlspecialchars($_GET['idChampEditar']));
        $name = htmlspecialchars($_POST['nomCampio']);
        $description = htmlspecialchars($_POST['descripcio']);
        $recurce = htmlspecialchars($_POST['resource']);
        $role = htmlspecialchars($_POST['role']);
        $nomUsuari = $_SESSION['usuari']; // Usuario actual desde la sesión
        

        if (modelComprovarChampNickname($idChampion, $nomUsuari) === "LaCreatEll") {
            if(modelModificarCampion($name, $description, $recurce, $role, $idChampion) === "Actualitzat") {
                echo '<script> alert("Champ actualitzat correctament"); </script>';
                header("Location: " . BASE_URL . "/index.php");
                exit();
            } else {
                echo '<script> alert("Error al actualitzar el campió"); </script>';
                header("Location: " . BASE_URL . "/index.php");
                exit();
            }
        } else {
            // Denegar l'acceso i mostrar un missatge d'error
            echo '<script> alert("Error NO tens permisos per editar aquest campió"); </script>';
            header("Location: " . BASE_URL . "/index.php");
            exit();
        }
    } else if (isset($_GET['idChampEditar'])) {
        $idChampion = trim(htmlspecialchars($_GET['idChampEditar']));
        $nomUsuari = $_SESSION['usuari']; // Usuari actual desde la sesión

        if (modelComprovarChampNickname($idChampion, $nomUsuari) === "LaCreatEll") {
            $champ = modelObtenirChamp($idChampion);
        } else {
            echo '<script> alert("Error NO tens permisos per editar aquest campió"); </script>';
            header("Location: " . BASE_URL . "/index.php");
            exit();
        }
    }
?>