<?php
require_once '../env.php';
require_once BASE_PATH . '/model/usuaris.model.php'; // Modelo para manejar usuarios
require_once BASE_PATH . '/lib/HybridAuth/vendor/autoload.php';

use Hybridauth\Hybridauth;

try {
    $config = require BASE_PATH . '/lib/HybridAuth/hybridauth_config.php'; // Ruta al archivo de configuración
    $hybridauth = new Hybridauth($config);

    // Autententificació con Reddit
    $adapter = $hybridauth->authenticate('Reddit');

    // Obtenir info del Usuari
    $userProfile = $adapter->getUserProfile();

    $username = $userProfile->displayName;
    echo "<script>alert('Username: $username');</script>";
    $email = ($userProfile->email === "null") ? "null" : $userProfile->email;
    $firstName = ($userProfile->firstName === "null") ? "nom" : $userProfile->firstName;

    $administrador = '0';
    $urlImg = "/vistaGlobal/imgPerfil/default.png";

    if (modelNickNameExisteixReddit($username) === "NoHiHaNickname") {
        $username = uniqid("user_");
        // Verificación del correo y creación del usuario
        if ($email === null) {
            $email = uniqid($username) . "@gmail.com";
            $shaCreat = afegirUsuariHybridAuth($username, $email, $firstName, $administrador, $urlImg);

        } else {
            $username = uniqid("user_");
            $shaCreat = afegirUsuariHybridAuth($username, $email, $firstName, $administrador, $urlImg);
        }
        
    } else {
        $shaCreat = "UsuariCreat";
    }
    

    // Verificar si l'Usuari s'ha creat correctament
    if ($shaCreat === "UsuariCreat") {
        session_start();
        $_SESSION['usuari'] = $username;
        $_SESSION['administrador'] = $administrador;
        echo "<script>
            alert('Usuari creat correctament, $username');
            window.location.href = '../index.php'; // Redirige a la página deseada
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Error al crear l\'usuari.');
            window.location.href = '../index.php'; // Redirige a la página de error
        </script>";
        exit();
    }

    // Desconectar el adaptador
    $adapter->disconnect();
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
