<?php 
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if(isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; }
require_once '../env.php';
require_once BASE_PATH . "/model/eliminarUsuari.model.php";


if (isset($_GET["nickname"]) && isset($_GET["action"])) {
    $numUsuari = trim(htmlspecialchars($_GET["nickname"]));
    $action = trim(htmlspecialchars($_GET["action"]));

    // Executar si ens han passat "delete" per confirmar-ho
    if ($action === "delete") {

        //  Ara eliminem el campio
        if (modelEliminarUsuari($numUsuari) === "ELIMINAT") {

            // Alerta de que s'ha eliminat l'Usuari
            echo '<script> alert("USUARI ELIMINAT!!"); window.location.href = "../index.php"; </script>';
            exit();

        } else {
            //  Sino ens envia directement al index despres de 3 segons
            echo '<script> alert("ERROR no s\'ha eliminar el Usuari"); window.location.href = "../index.php"; </script>';
            exit();

        }

    } else {
        echo '<script> alert("Error"); window.location.href = "../index.php"; </script>';
        exit();
    }

} else {
    echo '<script> alert("Error"); window.location.href = "../index.php"; </script>';
    exit();
}


?>