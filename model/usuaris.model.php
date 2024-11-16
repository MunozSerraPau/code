<?php 
// Pau Muñoz Serra

// Comprova si l'Usuari existeix i si es el cas ens retorna la seva contrasenya encriptada
function modelNickNameExisteixLogin(PDO $connexio, string $username) {
    try {
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


// 
function modelContrasenyaIgualLogin(PDO $connexio, string $username, string $password) {
    try {
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


// Afegim un nou Usari amb totes les dades que li passem
function modelAfegeixUsuari(PDO $connexio, string $nom, string $cognoms, string $correu, string $nickname, string $contrasenya) {
    try {
        $sql = "INSERT INTO usuaris (nom, cognoms, correu, nickname, contrasenya) VALUES (:nom, :cognoms, :correu, :nickname, :contrasenya)";
        $statement = $connexio->prepare($sql);
        $statement->execute( 
            array(
            ':nom' => $nom,
            ':cognoms' => $cognoms,
            ':correu' => $correu,
            ':nickname' => $nickname, 
            ':contrasenya' => $contrasenya )
        );

        return "SiCreat";

    } catch(PDOException $e){
        return $e;
    }


}


// Funció per actualitzar una nova contrasenya segosn el nickname que li passem (la contrasenya esta iencriptada quan la guardem)
function modelCanviContrasenya(PDO $connexio, string $nickName, string $contraNovaV1) {
    try {
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


?>