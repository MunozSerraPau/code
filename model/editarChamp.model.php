<?php
// Pau Muñoz Serra

function modelObtenirChamp($connexio, $idChampion) {
    $sql = "SELECT * FROM campeones WHERE id = :idChampion";
    $stmt = $connexio->prepare($sql);

    $stmt->execute(
        array(
            ":idChampion" => $idChampion
        )
    );

    $champ = $stmt->fetch();
    return $champ;
}


function modelComprovarChampNickname($connexio, $idChampion, $username) {
    $sql = "SELECT * FROM campeones WHERE id = :idChampion AND creator = :username";
    $stmt = $connexio->prepare($sql);

    $stmt->execute(
        array(
            ":idChampion" => $idChampion,
            ":username" => $username
        )
    );

    if ($stmt->rowCount() === 1) {
        return "LaCreatEll";
    } else {
        return "NoLaCreatEll";
    }
    
    return $result;
}


// Actualitzar un campió segons al seva ID amb parametres nous
function modelModificarCampion(PDO $connexio, string $nom, string $descripcio, string $recurs, string $rol, string $id) {
    try {
        $sql = "UPDATE campeones SET name = :namee, description = :descriptionn, resource = :resourcee, role = :rolee WHERE id = :id";
        $statement = $connexio->prepare($sql);
        $statement->execute( 
            array(
            ':namee' => $nom, 
            ':descriptionn' => $descripcio,
            ':resourcee' => $recurs,
            ':rolee' => $rol,
            ':id' => $id
            )
        );
        return "Actualitzat";


    } catch(PDOException $e) {
        return "NoActualitzat";
    }
}

?>