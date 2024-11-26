<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once BASE_PATH . "/model/paginacioUsuaris.model.php";


$llistaUsuaris = selectObtenirTotsUsuaris();
?>