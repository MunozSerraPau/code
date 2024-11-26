<?php 
// Pau Muñoz Serra
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    if(isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; }
    require_once '../env.php';
    require_once BASE_PATH . "/model/eliminarChamp.model.php";




    if (isset($_GET["id"]) && isset($_GET["action"])) {
        $idChampion = trim(htmlspecialchars($_GET["id"]));
        $action = trim(htmlspecialchars($_GET["action"]));

        // Executar si ens han passat "delete" per confirmar-ho
        if ($action === "delete") {

            // Comprovem si l'usuari coinsideix amb la id del camp
            if(modelComprovarUsuariId($nomUsuari, $idChampion) === "LaCreatEll") {

                //  Ara eliminem el campio
                if (modelEliminarCampion($idChampion) === "ELIMINAT") {

                    // esperem 3 segons i ens redirigeix al index.php
                    echo '<script> alert("Campio ELIMINAT!!"); </script>';
                    header("Location: " . BASE_URL . "/index.php");
                    exit();

                } else {
                    //  Sino ens envia directement al index despres de 3 segons
                    echo '<script> alert("Error al eliminar el campio"); </script>';
                    header("Location: " . BASE_URL . "/index.php");
                    exit();

                }
            } else {
                echo '<script> alert("Error al eliminar el campio"); </script>';
                header("Location: " . BASE_URL . "/index.php");
                exit();

            }

        } else {
            echo '<script> alert("Error al eliminar el campio"); </script>';
            header("Location: " . BASE_URL . "/index.php");
            exit();
        }

    } else {
        echo '<script> alert("Error al eliminar el campio"); </script>';
        header("Location: " . BASE_URL . "/index.php");
        exit();
    }

?>