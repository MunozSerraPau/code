<?php
require_once '../env.php';
require_once BASE_PATH . '/model/usuaris.model.php'; // Modelo para manejar usuarios
require_once BASE_PATH . '/lib/HybridAuth/vendor/autoload.php';

use Hybridauth\Hybridauth;

try {
    $config = require BASE_PATH . '/lib/HybridAuth/hybridauth_config.php'; // Ruta al archivo de configuración
    $hybridauth = new Hybridauth($config);

    // Autenticación con Reddit
    $adapter = $hybridauth->authenticate('Reddit');

    // Obtener información del perfil del usuario
    $userProfile = $adapter->getUserProfile();

    // Depuración: Verificamos los valores que hemos recibido
    echo "<script> alert('Perfil obtenido: $userProfile->displayName'); </script>";

    $username = $userProfile->displayName;
    $email = ($userProfile->email === "null") ? "null" : $userProfile->email;
    $firstName = ($userProfile->firstName === "null") ? "null" : $userProfile->firstName;
    $administrador = '0';
    $urlImg = "/vistaGlobal/imgPerfil/default.png";

    // Verificación del correo y creación del usuario
    if ($email === "null") {
        if (modelNickNameExisteix($username) === "NoHiHaNickname") {
            $shaCreat = afegirUsuariHybridAuth($username, $email, $firstName, $administrador, $urlImg);
        } else {
            // Si el nickname ya existe, generamos uno único
            $username = uniqid("user_");
            $shaCreat = afegirUsuariHybridAuth($username, $email, $firstName, $administrador, $urlImg);
        }
    } else {
        if (modelNickNameExisteix($username) === "NoHiHaNickname") {
            $email = uniqid($username) . "@gmail.com";
            $shaCreat = afegirUsuariHybridAuth($username, $email, $firstName, $administrador, $urlImg);
        } else {
            $username = uniqid("user_");
            $email = uniqid($username) . "@gmail.com";
            $shaCreat = afegirUsuariHybridAuth($username, $email, $firstName, $administrador, $urlImg);
        }
    }

    // Depuración: Confirmación de creación
    echo "<script> alert('Usuario creado: $shaCreat'); </script>";

    // Verificamos si el usuario fue creado correctamente
    if ($shaCreat === "UsuariCreat") {
        session_start();
        $_SESSION['usuari'] = $username;
        $_SESSION['administrador'] = $administrador;
        echo "<script>
            alert('Usuari creat correctament, $username, $administrador');
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
