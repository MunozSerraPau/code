<?php 
// Pau Muñoz Serra
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();

// Obtenri info del Usuari
function modelObtenirInfoUsuari( $username ) {
    global $connexio;
    $sql = "SELECT * FROM usuaris WHERE nickname = :usuari";
    $stmt = $connexio->prepare($sql);

    $stmt->execute(
        array(
            ":usuari" => $username
        )
    );

    $champ = $stmt->fetch();
    return $champ;
}


// Actualitzar les dades del Usuari
function modelUpdateDadesUsuari( $name, $cognoms, $correu, $nickname, $urlImg ) {
    try {
        global $connexio;
        $sql = "UPDATE usuaris SET nom = :nom, cognoms = :cognoms, correu = :correu, nickname = :username, imgPerfil = :urlImg WHERE nickname = :nickname";
        $statement = $connexio->prepare($sql);
        $statement->execute( 
            array(
            ':nom' => $name,
            ':cognoms' => $cognoms,
            ':correu' => $correu,
            ':username' => $nickname,
            ':urlImg' => $urlImg,
            ':nickname' => $nickname
            )
        );

        if ($statement->rowCount() > 0) {
            return "Actualitzat";
        } else {
            return "NoActualitzat";
        }

    } catch(PDOException $e) {
        return "NoActualitzat";
    }
}

function modelUpdateDadesUsuariNoImg ( $name, $cognoms, $correu, $nickname ) {
    try {
        global $connexio;
        $sql = "UPDATE usuaris SET nom = :nom, cognoms = :cognoms, correu = :correu, nickname = :username WHERE nickname = :nickname";
        $statement = $connexio->prepare($sql);
        $statement->execute(
            array(
            ':nom' => $name,
            ':cognoms' => $cognoms,
            ':correu' => $correu,
            ':username' => $nickname,
            ':nickname' => $nickname
            )
        );

        if ($statement->rowCount() > 0) {
            return "Actualitzat";
        } else {
            return "NoActualitzat";
        }

    } catch(PDOException $e) {
        return "NoActualitzat";
    }
}

function modelNomUsuariRepetit( $nouName, $nomUsuari ) {
    try{
        global $connexio;
        $sql = "SELECT COUNT(*) as numNickname FROM usuaris WHERE nickname = :nickname";
        $stmt = $connexio->prepare($sql);
        $stmt->execute(
            array(
                ":nickname" => $nouName
            )
        );

        $result = $stmt->fetch();
        if($result['numNickname'] >= 1) {
            return "Repetit";
        } else {
            return "NoRepetit";
        }
    } catch(PDOException $e) {
        return "Error";
    }
}

function modelCorreuRepetit($correu) {
    try{
        global $connexio;
        $sql = "SELECT COUNT(*) as numCorreu FROM usuaris WHERE correu = :correu";
        $stmt = $connexio->prepare($sql);
        $stmt->execute(
            array(
                ":correu" => $correu
            )
        );

        $result = $stmt->fetch();
        if($result['numCorreu'] >= 2) {
            return "Repetit";
        } else {
            return "NoRepetit";
        }
    } catch(PDOException $e) {
        return "Error";
    }
}


// Retorna la ruta de la img de perfil
function modelObtenirUrlImgPerfilv2($username) {
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
?>