<?php
    // Pau Muñoz Serra
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    if (isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; }


    require_once BASE_PATH . "/model/editarUsuaris.model.php";


    $nomUsuari = $_SESSION['usuari']; // Usuari actual desde la sesión

    $usuariInfo = modelObtenirInfoUsuari($nomUsuari);

    // Verificar que l'Usuari estigui loguejat
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUsuari'])) {
        $name = htmlspecialchars($_POST['firstname']);
        $cognoms = htmlspecialchars($_POST['lastname']);
        $correu = htmlspecialchars($_POST['email']);
        $nickname = htmlspecialchars($_POST['nickname']);
        
        // $urlImg = htmlspecialchars($_POST['championImage']);
                
        $nomUsuari = $_SESSION['usuari']; // Usuario actual desde la sesión
        

        
        if(modelModificarCampion($name, $description, $recurce, $role, $idChampion) === "Actualitzat") {
            echo '<script> alert("Champ actualitzat correctament"); window.location.href = "' . BASE_URL . '/index.php"; </script>';
            exit();
        } else {
            echo '<script> alert("Error al actualitzar el campió"); window.location.href = "' . BASE_URL . '/index.php"; </script>';
            exit();
        }
    } 

?>