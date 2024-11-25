<?php
// Pau Munoz Serra

    // elimina la session en la que estem
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_destroy();
    header('Location: ../index.php');
?>