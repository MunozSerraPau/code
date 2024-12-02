<?php
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();

// Pau Muñoz Serra
function modelCorreuExisteixEnviar($correu) {
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

function afegirTokenContraRecuperacio( $email, $token, $expiration ) {
    try {
        global $connexio;
        $stmt = $connexio->prepare("UPDATE usuaris SET token_recuperar = :token, token_expiration = :expiration WHERE correu = :email");
        $stmt->execute(
            array(
                ':token' => $token,
                ':expiration' => $expiration,
                ':email' => $email
            )
        );


    } catch (PDOException $e) {
        $error = "Falla a la connexio a la Base de Dades";
        return $error;
    }
}

function actualitzarContrasenya($token, $novaContrasenya) {
    try {
        global $connexio;
        $sql = "UPDATE usuaris SET contrasenya = :novaContrasenya WHERE token_recuperar = :token AND token_expiration > NOW()";
        $stmt = $connexio->prepare($sql);
        $stmt->execute(
            array(
                ':novaContrasenya' => $novaContrasenya,
                ':token' => $token
            )
        );

        if ($stmt->rowCount() > 0) {
            return "ContrasenyaActualitzada";
        } else {
            return "Token Invalid o ha Expirat";
        }

    } catch (PDOException $e) {
        $error = "Falla a la connexio a la Base de Dades";
        return $error;
    }
}


?>