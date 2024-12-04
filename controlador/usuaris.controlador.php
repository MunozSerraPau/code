<?php
// Pau Munoz Serrra
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once BASE_PATH . "/model/usuaris.model.php";
$error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // mira si ens han passat parametre per afegir un nou usuari
    if (isset($_POST['singup'])) {
        // Guardem les dades
        $nom = htmlspecialchars($_POST['firstname']);
        $cognoms = htmlspecialchars($_POST['lastname']);
        $correu = htmlspecialchars($_POST['email']);
        $nickname = htmlspecialchars($_POST['nickname']);
        $contrasenya = htmlspecialchars($_POST['password']);
        $confirmPassword = htmlspecialchars($_POST['confirm-password']);

        if (isset($_FILES['championImage']) && $_FILES['championImage']['error'] !== UPLOAD_ERR_NO_FILE) {
            if ($_FILES['championImage']['error'] === UPLOAD_ERR_OK) {
                $nomGenericImatge = $_FILES['championImage']['tmp_name'];   
                echo "Nom genèric de la imatge: " . $nomGenericImatge . "<br>"; 
                $nomImg = uniqid(prefix:"img") . basename($_FILES['championImage']['name']); 
                $rutaDestino = "/vistaGlobal/imgPerfil/" . $nomImg;

            }else {
                echo "Error al subir el archivo: " . $_FILES['championImage']['error'];
                
            }
        } else {
            $nomGenericImatge = "";
            $rutaDestino = "/vistaGlobal/imgPerfil/default.png";

        }


        // Creem l'Usuari
        $shaCreat = afegirUsuari($nom, $cognoms, $correu, $nickname, $contrasenya, $confirmPassword, $rutaDestino, $nomGenericImatge);
        

        // Fem la comprovació
        if($shaCreat === "SiCreat") {
            $error = "S'ha creat Correctament";
        } else {
            $error = $shaCreat;
        }

    // mira si ens han passat parametre per fer login
    } else if (isset($_POST['login'])) {
        // guardem les dades i iniciem sessió comprobant si tenim un user i password en la nostra bd
        $nickname = htmlspecialchars($_POST['username']);
        $contrasenya = htmlspecialchars($_POST['password']);
        $clauPrivadaRecaptcha = "6LeC3owqAAAAAAL_IGKWdgmxt_FtfXkLLhzFGas8";
        $recaptchaResponse = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : null;


        // Inicciem el reCAPTCHA amb 0 intents
        if(!isset($_SESSION['loginRecaptcha'])) {
            $_SESSION['loginRecaptcha'] = 0;
        }

        // Si els intents son >=3, validar el reCAPTCHA
        if ($_SESSION['loginRecaptcha'] >= 3) {
            // Realitzar la peticó a la API de reCAPTCHA
            $recaptchaVerify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$clauPrivadaRecaptcha&response=$recaptchaResponse");
            $recaptchaResult = json_decode($recaptchaVerify, true);

            if (!$recaptchaResult["success"]) {
                $error = "ERROR amb el reCAPTCHA";
            }
        }

        if ($error === "") {
            $existeixUsuari = comprovarUsuari($nickname, $contrasenya);

            if ($existeixUsuari === "UsuariConnectat") {
                

                $_SESSION['loginRecaptcha'] = 0;
                header("Location: ../");
                exit();
            } else {
                $_SESSION['loginRecaptcha']++;
                $error .= $existeixUsuari;
            }
        }
        

    } else if (isset($_POST['canviContrasenya'])) {
        //guardem les dades i canviem la contrasenye

        $contraActual = htmlspecialchars($_POST['contrasenyaActual']);
        $contraNovaV1 = htmlspecialchars($_POST['contrasenyaNova1']);
        $contraNovaV2 = htmlspecialchars($_POST['contrasenyaNova2']);

        $canviContrasenya = canviarContrasenya($contraActual, $contraNovaV1, $contraNovaV2);
        $error = $canviContrasenya;

    }

}


function comprovarUsuari($username, $password) {

    //mirem si hi halgun camp buit
    if (empty($username) && empty($password)) {
        $error = "Nom d'Usuari i contrasenya BUIDA!";
    } elseif (empty($username)){
        $error = "El nom d'Usuari esta BUIT!";
    } elseif (empty($password)) {
        $error = "La contrasenya esta BUIDA!";
    } else {
        
        // Obtenim la contrasenya
        $contra = modelNickNameExisteixLogin($username);
        //mirem si la contrassenya es igual
        if(password_verify($password, $contra)) {


            // Creem la session i guardem el nickname del Usuari
            $error = "UsuariConnectat";
            $_SESSION['usuari'] = $username;
            $_SESSION['fotoPerfil'] = modelObtenirUrlImgPerfil($username);
            if (modelComprovarUsuariAdministrador($username) == "EsAdmin") {
                $_SESSION['admin'] = "true";
            } else {
                $_SESSION['admin'] = false;
            }
            
            // Si l'Usuari ha seleccionat "Remember-me", establecer guardem uan cokkies amb el nom d'Usuari
            if (isset($_POST['recordam'])) {
                setcookie('rememberMeUser', $username, time() + (86400 * 7), "/"); // 86400 = 1 dia, la cookie durara 7 dies
            }
            
            return $error;
        } elseif($contra === "NoHiHaUsuari") {
            $error = "No hi ha cap Usuari amb aquest NICKNAME";
            unset($_POST['username']);

        } else {
            $error = "La CONTRASENYA no coninsideix";

        }

    }

    return $error;
}

function afegirUsuari($nom, $cognoms, $correu, $nickname, $contrasenya, $confirmPassword, $rutaDestino, $nomGenericImatge) {    
    // El regex per fer la comprovació de seguretat de la contrasenya
    $validarContrasenya = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=\[\]{};:,.<>?])[A-Za-z\d!@#$%^&*()_\-+=\[\]{};:,.<>?]{8,}$/';

    $error = "<br>";
    
    // Mirem si hi ha algun camp buit, si la contrasenya compleix els requisits i si les dos contrasenyes son iguals
    if(empty($nom)) {
        $error .= "Error no has ficat el NOM<br>";
    } else if (empty($cognoms)) {
        $error .= "Error no has ficat els COGNOMS<br>";
    } else if (empty($correu)) {
        $error .= "Error no has ficat el CORREU<br>";
    } else if (modelCorreuExisteix($correu) == "CorreuExisteix") {
        $error .= "Error el CORREU ja existeix<br>";
    } else if (empty($nickname)) {
        $error .= "Error no has ficat el NICKNAME<br>";
    } else if (modelNickNameExisteix($nickname) == "NicknameExisteix") {
        $error .= "Error el NICKNAME ja existeix<br>";
    } else if (empty($contrasenya)) {
        $error .= "Error no has ficat CONTRASENYA<br>";
    } elseif (!preg_match($validarContrasenya, $contrasenya)) {
        unset($_POST['password']);
        unset($_POST['confirm-password']);
        $error .= "La nova CONTRASENYA no compleix els requisits. <br>(1 majúscula, 1 minúscula, 1 caràcter especial, 1 número i 8 caracters mínim.)<br>";
    } else if (empty($confirmPassword)) {
        $error .= "Error no has ficat la CONFIRMACIÓ de la CONTRASENYA<br>";
    } else if ($contrasenya !== $confirmPassword) {
        $error .= "Error les CONTRASENYES NO coinsideixen<br>";
    }
    
    // si no s'ha afegit res a error encriptem la contrasenya i creem l'Uusari
    if($error === "<br>") {
        $hashPassword = password_hash($contrasenya, PASSWORD_DEFAULT);

        echo "<br>" . $nomGenericImatge . "XXXXXXXXXXXXXX";
        echo "<br>XXXXXXXXXXXXXXX" . BASE_PATH . $rutaDestino . "XXXXXXXXXXXXXXX";

        if ($nomGenericImatge === "") {
            $crearUsuari = modelAfegeixUsuari($nom, $cognoms, $correu, $nickname, $hashPassword, $rutaDestino);

            unset($_POST['firstname']);
            unset($_POST['lastname']);
            unset($_POST['email']);
            unset($_POST['nickname']);
            unset($_POST['password']);
            unset($_POST['confirm-password']);

            return $crearUsuari;
        } else if (move_uploaded_file($nomGenericImatge, BASE_PATH . $rutaDestino)) {
            $crearUsuari = modelAfegeixUsuari($nom, $cognoms, $correu, $nickname, $hashPassword, $rutaDestino);

            unset($_POST['firstname']);
            unset($_POST['lastname']);
            unset($_POST['email']);
            unset($_POST['nickname']);
            unset($_POST['password']);
            unset($_POST['confirm-password']);

            return $crearUsuari;
        } else {
            $error = "Error al pujar l'arxiu<br>";
            return $error;
        }
    } else {
        return $error;
    }
}

function canviarContrasenya ($contraActual, $contraNovaV1, $contraNovaV2) {
    // El regex per fer la comprovació de seguretat de la contrasenya
    $validarContrasenya = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=\[\]{};:,.<>?])[A-Za-z\d!@#$%^&*()_\-+=\[\]{};:,.<>?]{8,}$/';


    $error = "<br>";


    // Mirem si hi ha algun camp buit, si la nova contrasenya compleix els requisits i si les dos contrasenyes son iguals
    if(empty($contraActual)) {
        $error .= "Error no has ficat la CONTRASENYA ACTUAL<br>";

    } elseif (empty($contraNovaV1)) {
        $error .= "Error no has ficat la CONTRASENYA NOVA<br>";

    } elseif (empty($contraNovaV2)) {
        $error .= "Error no has ficat la CONTRASENYA NOVA REPETIDA<br>";

    } elseif (!preg_match($validarContrasenya, $contraNovaV1)) {
        $error .= "La nova CONTRASENYA no compleix els requisits. <br>(1 majúscula, 1 minúscula, 1 caràcter especial, 1 número i 8 caracters mínim.)<br>";
    } elseif ($contraNovaV1 != $contraNovaV2) {
        unset($_POST['contraNovaV1']);
        unset($_POST['contraNovaV2']);
        $error .= "Error les CONTRASENYAS novas NO COINSIDEIX";

    } else {
        //obtenim el usuari actual
        $nomUsuari = $_SESSION['usuari'];
        // obtenim la contra actual
        $contra = modelNickNameExisteixLogin($nomUsuari);
        
        //mirem que sigui igual
        if(password_verify($contraActual, $contra)) {
            // encriptem la nova contrasenya
            $hashPassword = password_hash($contraNovaV1, PASSWORD_DEFAULT);
            // i la canviem amb la noova contrasenya encriptada
            $canviContrasenya = modelCanviContrasenya($nomUsuari, $hashPassword);
            // aquí verifiquem que s'ha actualitzat
            if ($canviContrasenya === "ContrasenyaCanviada"){
                $error = "Contrasenya Actualitzada";
                unset($_POST['contrasenyaActual']);
                unset($_POST['contrasenyaNova1']);
                unset($_POST['contrasenyaNova2']);

            } else {
                $error = $canviContrasenya;
            }
        } else {
            $error = "La CONTRASENYA no es la del USUARI ";
        } 
    }

    return $error;
}

?>