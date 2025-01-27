<?php 
// Pau Muñoz Serra
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    if(isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; }
    require_once '../env.php';
    require_once BASE_PATH . "/model/eliminarEquip.model.php";

    var_dump("hola");


    if (isset($_GET["id"]) && isset($_GET["action"])) {
        $idEquip = trim(htmlspecialchars($_GET["id"]));
        $action = trim(htmlspecialchars($_GET["action"]));

        // Executar si ens han passat "delete" per confirmar-ho
        if ($action === "delete") {

            // Comprovem si l'usuari coinsideix amb la id del camp
            if(modelComprovarUsuariIdEquip($nomUsuari, $idEquip) === "LaCreatEll") {

                //  Ara eliminem l'Equip
                if (modelEliminarEquip($idEquip) === "ELIMINAT") {

                    // esperem 3 segons i ens redirigeix al vista/llistatEquips.vista.php
                    echo '<script> alert("Equip ELIMINAT!!"); </script>';
                    header("Location: " . BASE_URL . "/vista/llistatEquips.vista.php");
                    exit();

                } else {
                    //  Sino ens envia directement al index despres de 3 segons
                    echo '<script> alert("Error al eliminar l\'Equip"); </script>';
                    header("Location: " . BASE_URL . "/vista/llistatEquips.vista.php");
                    exit();

                }
            } else {
                echo '<script> alert("Error al eliminar l\'Equip"); </script>';
                header("Location: " . BASE_URL . "/vista/llistatEquips.vista.php");
                exit();

            }

        } else {
            echo '<script> alert("Error al eliminar l\'Equip"); </script>';
            header("Location: " . BASE_URL . "/index.php");
            exit();
        }

    } else {
        echo '<script> alert("Error al eliminar l\'Equip"); </script>';
        header("Location: " . BASE_URL . "/index.php");
        exit();
    }

?>