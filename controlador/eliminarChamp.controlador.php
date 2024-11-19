<?php 
// Pau Muñoz Serra



    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    if(isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; }
    require_once '../env.php';
    require_once BASE_PATH . "/model/eliminarChamp.model.php";
    require_once BASE_PATH . "/controlador/connexio.php";
    $connexio = connexio();



    if (isset($_GET["id"]) && isset($_GET["action"])) {
        $idChampion = trim(htmlspecialchars($_GET["id"]));
        $action = trim(htmlspecialchars($_GET["action"]));

        // Executar si ens han passat "delete" per confirmar-ho
        if ($action === "delete") {

            // Comprovem si l'usuari coinsideix amb la id del camp
            if(modelComprovarUsuariId($connexio, $nomUsuari, $idChampion) === "LaCreatEll") {

                //  Ara eliminem el campio
                if (modelEliminarCampion($connexio, $idChampion) === "ELIMINAT") {

                    // esperem 3 segons i ens redirigeix al index.php
                    echo '<script> alert("Campio ELIMINAT!!"); window.location.href = "../index.php"; </script>';
                    exit();

                } else {
                    //  Sino ens envia directement al index despres de 3 segons
                    echo '<script> alert("Error al eliminar el campio"); window.location.href = "../index.php"; </script>';
                    exit();

                }
            } else {
                echo '<script> alert("Error al eliminar el campio"); window.location.href = "../index.php"; </script>';
                exit();

            }

        } else {
            echo '<script> alert("Error al eliminar el campio"); window.location.href = "../index.php"; </script>';
            exit();
        }

    } else {
        echo '<script> alert("Error al eliminar el campio"); window.location.href = "../index.php"; </script>';
        exit();
    }

?>