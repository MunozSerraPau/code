<?php
    // Pau Muñoz Serra
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    if (isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; }


    require_once BASE_PATH . "/model/editarUsuaris.model.php";

    $error = "<br>";

    // Verificar que l'Usuari estigui loguejat
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUsuari'])) {
        $name = htmlspecialchars($_POST['firstname']);
        $cognoms = htmlspecialchars($_POST['lastname']);
        $correu = htmlspecialchars($_POST['email']);
        $nickname = htmlspecialchars($_POST['nickname']);
                        
        $nomUsuari = $_SESSION['usuari']; // Usuario actual desde la sesión

        if (isset($_FILES['userImg']) && $_FILES['userImg']['error'] !== UPLOAD_ERR_NO_FILE) {
            if ($_FILES['userImg']['error'] === UPLOAD_ERR_OK) {
                $nomGenericImatge = $_FILES['userImg']['tmp_name'];   
                echo "Nom genèric de la imatge: " . $nomGenericImatge . "<br>"; 
                $nomImg = uniqid(prefix:"img") . basename($_FILES['userImg']['name']); 
                $rutaDestino = "/vistaGlobal/imgPerfil/" . $nomImg;

                if (modelNomUsuariRepetit($nickname, $nomUsuari) === "NoRepetit") {
                    if (modelCorreuRepetit($correu) === "NoRepetit") {
                        if (move_uploaded_file($nomGenericImatge, BASE_PATH . $rutaDestino)){
                            if(modelUpdateDadesUsuari( $name, $cognoms, $correu, $nickname, $urlImg ) === "Actualitzat") {
                                $usuariInfo = modelObtenirInfoUsuari($nomUsuari);
                                $_SESSION['fotoPerfil'] = modelObtenirUrlImgPerfilv2($nomUsuari);
                                $error = "Usuari ACTUALITZAT CORRECTAMENT!";
                            } else {
                                $usuariInfo = modelObtenirInfoUsuari($nomUsuari);
                                $error = "ATENCIO, no s'ha fet cap canvi!";
                            }
                        }else {
                            $usuariInfo = modelObtenirInfoUsuari($nomUsuari);
                            $error = "Error al subir el archivo: " . $_FILES['userImg']['error'];
                        }
                    } else {
                        $usuariInfo = modelObtenirInfoUsuari($nomUsuari);
                        $error = "ERROR, el Correu ja existeix amb IMG!";
                    }
                } else {
                    $usuariInfo = modelObtenirInfoUsuari($nomUsuari);
                    // Denegar l'acceso i mostrar un missatge d'error
                    $error = "ERROR, el nom d'Usuari ja existeix amb IMG!";
                }

            }else {
                $usuariInfo = modelObtenirInfoUsuari($nomUsuari);
                $error = "Error al subir el archivo: " . $_FILES['userImg']['error']; 
            }
        } else {
            if (modelNomUsuariRepetit($nickname, $nomUsuari) === "NoRepetit") {
                if (modelCorreuRepetit($correu) === "NoRepetit") {
                    if(modelUpdateDadesUsuariNoImg( $name, $cognoms, $correu, $nickname ) === "Actualitzat") {
                        $usuariInfo = modelObtenirInfoUsuari($nomUsuari);
                        $_SESSION['fotoPerfil'] = modelObtenirUrlImgPerfilv2($nomUsuari);
                        $error = "Usuari ACTUALITZAT CORRECTAMENT!";
                    } else {
                        $usuariInfo = modelObtenirInfoUsuari($nomUsuari);
                        $error = "ATENCIO, no s'ha fet cap canvi!";
                    }
                } else {
                    $usuariInfo = modelObtenirInfoUsuari($nomUsuari);
                    $error = "ERROR, el Correu ja existeix sense IMG!";
                }
            } else {
                $usuariInfo = modelObtenirInfoUsuari($nomUsuari);
                // Denegar l'acceso i mostrar un missatge d'error
                $error = "ERROR, el nom d'Usuari ja existeix sense IMG!";
            }
        }
    } else {
        $nomUsuari = $_SESSION['usuari']; // Usuari actual desde la sesión

        $usuariInfo = modelObtenirInfoUsuari($nomUsuari);
    }
?>