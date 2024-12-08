<?php
// Pau Munoz Serra
$error = "";    

require_once BASE_PATH . '/model/recuperarContrasenya.model.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['canviContrasenyaRecuperacio'])) {
    $contraNovaV1 = htmlspecialchars($_POST['contrasenyaNova1']);
    $contraNovaV2 = htmlspecialchars($_POST['contrasenyaNova2']);
    $token = htmlspecialchars($_GET['token']);

    $alertaActualitzacio = canviarContrasenya($contraNovaV1, $contraNovaV2, $token);

    $error = $alertaActualitzacio;
}

function canviarContrasenya ($contraNovaV1, $contraNovaV2, $token) {
    // El regex per fer la comprovació de seguretat de la contrasenya
    $validarContrasenya = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=\[\]{};:,.<>?])[A-Za-z\d!@#$%^&*()_\-+=\[\]{};:,.<>?]{8,}$/';


    $error = "<br>";


    // Mirem si hi ha algun camp buit, si la nova contrasenya compleix els requisits i si les dos contrasenyes son iguals
    if (empty($contraNovaV1)) {
        $error .= "Error no has ficat la CONTRASENYA NOVA<br>";

    } elseif (empty($contraNovaV2)) {
        $error .= "Error no has ficat la CONTRASENYA NOVA REPETIDA<br>";

    } elseif (!preg_match($validarContrasenya, $contraNovaV1)) {
        $error .= "La nova CONTRASENYA no compleix els requisits. <br>(1 majúscula, 1 minúscula, 1 caràcter especial, 1 número i 8 caracters mínim.)<br>";

    } elseif ($contraNovaV1 != $contraNovaV2) {
        unset($_POST['contrasenyaNova1']);
        unset($_POST['contrasenyaNova2']);
        $error .= "Error les CONTRASENYAS novas NO COINSIDEIX";

    } else {
        // encriptem la nova contrasenya
        $hashPassword = password_hash($contraNovaV1, PASSWORD_DEFAULT);

        // i la canviem amb la noova contrasenya encriptada
        $canviContrasenya = actualitzarContrasenya($token, $hashPassword);

        // aquí verifiquem que s'ha actualitzat
        if ($canviContrasenya === "ContrasenyaActualitzada"){
            unset($_POST['contrasenyaNova1']);
            unset($_POST['contrasenyaNova2']);
            return "Contrasenya Actualitzada";

        } else {
            return $canviContrasenya;
        }
    }

    return $error;
}

?>