<?php
// Pau Muñoz Serra
// 11.- Eviteu fer servir fitxer que només cridin a un altra fitxer, sense res més de codi.


if (session_status() === PHP_SESSION_NONE) { session_start(); }
if(isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; }

require_once BASE_PATH . "/model/paginacioUsuaris.model.php";


if (mirarUsuariAdmin($nomUsuari) == "EsAdmin") {
    $llistaUsuaris = selectObtenirTotsUsuaris();
} else {
    header("Location: " . BASE_URL . "/vistaGlobal/error/403.php");
}


?>