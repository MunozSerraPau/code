<?php
// Pau Munoz Serra

    // elimina la session en la que estem
    session_start();
    session_destroy();
    header('Location: ../index.php');
?>