<?php
// Pau Munoz Serra

    // elimina la session en la que estem
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_destroy();

    setcookie('paraulaBuscador', '', time() - 3600, "/");
    setcookie('ordre', '', time() - 3600, "/");
    setcookie('champsPerPagina', '', time() - 3600, "/");

    header('Location: ../index.php');
?>