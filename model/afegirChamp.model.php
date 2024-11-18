<?php 
// Pau Muñoz Serra


// require_once BASE_PATH . "/controlador/connexio.php";
// $connexio = connexio();


// Afegeix un nou campio a la base de dades
function modelAfegirCampio(PDO $connexio, string $nom, string $descripcio, string $recurs, string $rol, string $nickname) {
    try {
        $sql = "INSERT INTO campeones (name, description, resource, role, creator) VALUES (:namee, :descriptionn, :resourcee, :rolee, :creatorr)";
        $statement = $connexio->prepare($sql);
        $statement->execute( 
            array(
            ':namee' => $nom, 
            ':descriptionn' => $descripcio,
            ':resourcee' => $recurs,
            ':rolee' => $rol,
            ':creatorr' => $nickname
            )
        );
        return "SiCreat";

    } catch(PDOException $e) {
        return "NoCreat";
    }
}


// Fem la comprovació de si el nom del campio ja existeix o no
function modelComprovarNom (PDO $connexio, string $nom) {
    try {
        $sql = "SELECT * FROM campeones WHERE name = :nomChamp";
        $statement = $connexio->prepare($sql);
        $statement->execute( 
            array(
            ':nomChamp' => $nom)
        );

        if ($statement->rowCount() > 0){
            return "ChampDuplicat";
        } else {
            return "ChampNoDuplicat";
        }

    } catch(PDOException $e) {
        return "ChampDuplicat";
    }
}


?>