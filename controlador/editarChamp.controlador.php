<?php
    // Pau Muñoz Serra



    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    require_once '../env.php';
    require_once BASE_PATH . "/model/editarChamp.model.php";
    require_once BASE_PATH . "/controlador/connexio.php";
    $connexio = connexio();



    // Verificar que l'Usuari estigui loguejat
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $idChampion = trim(htmlspecialchars($_POST['id']));
        $nomUsuari = $_SESSION['username']; // Usuario actual desde la sesión
        echo $nomUsuari . "ferwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww";

        // Verificar que el artículo pertenece al usuario actual
        if (modelComprovarUsuariId($connexio, $nomUsuari, $idChampion) === "LaCreatEll") {
            // Permitir la edición
            header("Location: ./editarForm.php?id=$idChampion");
            exit();
        } else {
            // Denegar el acceso y mostrar mensaje
            echo '<div class="alert alert-danger">No tienes permiso para editar este campeón.</div>';
            header("refresh:3;url=../index.php");
            exit();
        }
    } else {
        // Redirigir si no hay ID válido
        echo '<div class="alert alert-danger">Petición inválida.</div>';
        header("refresh:3;url=../index.php");
        exit();
    }
?>