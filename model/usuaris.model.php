<?php 
// Pau Muñoz Serra
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();


// Comprova si l'Usuari existeix i si es el cas ens retorna la seva contrasenya encriptada
function modelNickNameExisteixLogin($username) {
    try {
        global $connexio;
        $sql = "SELECT contrasenya FROM usuaris WHERE nickname = :username";
        $statement = $connexio->prepare($sql);
        
        $statement->execute( 
            array(
            ':username' => $username
            )
        );
        
        $resultat = $statement->fetch(PDO::FETCH_ASSOC);

        if ($resultat) {
            return $resultat['contrasenya'];
        } else {
            return "NoHiHaUsuari";
        }

    } catch (PDOException $e) {
        $error = "Falla a la connexio a la Base de Dades";
        return $error;
    }
}


// Mira si al contrasenya es igual a la de la base de dades
function modelContrasenyaIgualLogin($username, $password) {
    try {
        global $connexio;
        $sql = "SELECT * FROM usuaris WHERE nickname = :username AND contrasenya = :contra";
        $statement = $connexio->prepare($sql);
        
        $statement->execute( 
            array(
            ':username' => $username,
            ':contra' => $password
            )
        );
        
        if ($statement->rowCount() > 0) {
            return "ContrasenyaCorrecta";
        } else {
            return "ContrasenyaIncorrecta";
        }

    } catch (PDOException $e) {
        $error = "Falla a la connexio a la Base de Dades";
        return $error;
    }
}


// Retorna la ruta de la img de perfil
function modelObtenirUrlImgPerfil($username) {
    try {
        global $connexio;
        $sql = "SELECT imgPerfil FROM usuaris WHERE nickname = :username";
        $statement = $connexio->prepare($sql);
        
        $statement->execute( 
            array(
            ':username' => $username
            )
        );
        
        $resultat = $statement->fetch(PDO::FETCH_ASSOC);

        if ($resultat) {
            return $resultat['imgPerfil'];
        } else {
            return "NoHiHaUsuari";
        }

    } catch (PDOException $e) {
        $error = "Falla a la connexio a la Base de Dades";
        return $error;
    }
}


// Mirar si el correu existeix
function modelCorreuExisteix($correu) {
    try {
        global $connexio;
        $sql = "SELECT correu FROM usuaris WHERE correu = :correu";
        $statement = $connexio->prepare($sql);
        
        $statement->execute(
            array(
                ':correu' => $correu
            )
        );
        
        $resultat = $statement->fetch(PDO::FETCH_ASSOC);

        if ($resultat) {
            return "CorreuExisteix";
        } else {
            return "NoHiHaCorreu";
        }

    } catch (PDOException $e) {
        $error = "Falla a la connexio a la Base de Dades";
        return $error;
    }
}


// Mira si el Nickname existeix
function modelNickNameExisteix($nickname) {
    try {
        global $connexio;
        $sql = "SELECT nickname FROM usuaris WHERE nickname = :nickname";
        $statement = $connexio->prepare($sql);
        
        $statement->execute(
            array(
                ':nickname' => $nickname
            )
        );
        
        $resultat = $statement->fetch(PDO::FETCH_ASSOC);

        if ($resultat) {
            return "NicknameExisteix";
        } else {
            return "NoHiHaNickname";
        }

    } catch (PDOException $e) {
        $error = "Falla a la connexio a la Base de Dades";
        return $error;
    }
}


// Afegim un nou Usari amb totes les dades que li passem
function modelAfegeixUsuari($nom, $cognoms, $correu, $nickname, $contrasenya, $rutaDestino) {
    try {
        global $connexio;
        $sql = "INSERT INTO usuaris (nom, cognoms, correu, nickname, contrasenya, imgPerfil) VALUES (:nom, :cognoms, :correu, :nickname, :contrasenya, :imgPerfil)";
        $statement = $connexio->prepare($sql);
        $statement->execute( 
            array(
            ':nom' => $nom,
            ':cognoms' => $cognoms,
            ':correu' => $correu,
            ':nickname' => $nickname, 
            ':contrasenya' => $contrasenya,
            ':imgPerfil' => $rutaDestino
            )
        );

        return "SiCreat";

    } catch(PDOException $e){
        return $e;
    }
}


// Funció per actualitzar una nova contrasenya segosn el nickname que li passem (la contrasenya esta iencriptada quan la guardem)
function modelCanviContrasenya($nickName, $contraNovaV1) {
    try {
        global $connexio;
        $sql = "UPDATE usuaris  SET contrasenya = :contrasenya WHERE nickname = :nom";
        $statement = $connexio->prepare($sql);
        $statement->execute( 
            array(
                ':contrasenya' => $contraNovaV1,
                ':nom' => $nickName
            )
        );

        return "ContrasenyaCanviada";
    } catch(PDOException $e) {
        return "Error amb la connexio o el Nom d'Usuari";
    }
}


// Fuunció per veure si l'Usuari es administrador o no
function modelComprovarUsuariAdministrador ($nickName) {
    try {
        global $connexio;
        $sql = "SELECT * FROM usuaris WHERE nickname = :nickname AND administrador = '1'";
        $statement = $connexio->prepare($sql);
        $statement->execute( 
            array(
                ':nickname' => $nickName
            )
        );

        if ($statement->rowCount() > 0) {
            return "EsAdmin";
        } else {
            return "NoEsAdmin";
        }
    } catch(PDOException $e) {
        return "Error amb la connexio o el Nom d'Usuari";
    }
}


// Funció per afegir usuari segons el HybridAuth
function afegirUsuariHybridAuth($username, $email, $firstName, $administrador, $urlImg) {
    try {
        global $connexio;

        // Preparamos la consulta SQL
        $sql = "INSERT INTO usuaris (nom, cognoms, correu, nickname, contrasenya, xarxa_social, administrador, imgPerfil) 
                VALUES (:nom, :cognoms, :correu, :nickname, :contrasenya, :xarxa_social, :administrador, :imgPerfil)";

        $statement = $connexio->prepare($sql);
        
        // Depuración: Mostramos la consulta SQL que se va a ejecutar
        echo "<script> alert('Ejecutando consulta: " . addslashes($sql) . "'); </script>";
        
        // Ejecutamos la consulta
        $statement->execute(
            array(
                ':nom' => $firstName,
                ':cognoms' => '',
                ':correu' => $email,
                ':nickname' => $username,
                ':contrasenya' => null,  // NULL para contrasenya
                ':xarxa_social' => 'Reddit',  // Red social usada
                ':administrador' => $administrador,
                ':imgPerfil' => $urlImg
            )
        );

        // Depuración: Verificamos cuántas filas fueron afectadas
        echo "<script> alert('Filas afectadas: " . $statement->rowCount() . "'); </script>";

        // Verificamos si la fila fue insertada correctamente
        if ($statement->rowCount() > 0) {
            return "UsuariCreat";
        } else {
            // Si no se creó el usuario
            echo "<script> alert('Error al crear l\'usuari: La consulta no afectó filas.'); </script>";
            return "ErrorCrearUsuari";
        }

    } catch(PDOException $e) {
        // Si hay algún error en la ejecución, lo mostramos
        echo "<script> alert('Error en la consulta SQL: " . addslashes($e->getMessage()) . "'); </script>";
        return $e;
    }
}

?>