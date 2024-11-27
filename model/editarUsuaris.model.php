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
        $sql = "UPDATE usuaris SET nom = :nom, cognoms = :cognoms, correu = :correu, imgPerfil = :urlImg WHERE nickname = :nickname";
        $statement = $connexio->prepare($sql);
        $statement->execute( 
            array(
            ':nom' => $name, 
            ':cognoms' => $cognoms,
            ':correu' => $correu,
            ':urlImg' => $urlImg,
            ':nickname' => $nickname
            )
        );
        return "Actualitzat";


    } catch(PDOException $e) {
        return "NoActualitzat";
    }
}

?>