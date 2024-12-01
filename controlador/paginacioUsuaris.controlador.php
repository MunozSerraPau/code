<?php
// Pau Muñoz Serra
// 11.- Eviteu fer servir fitxer que només cridin a un altra fitxer, sense res més de codi.


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once BASE_PATH . "/model/paginacioUsuaris.model.php";


$llistaUsuaris = selectObtenirTotsUsuaris();
?>