<?php 
// Pau Muñoz Serra

// Comprovació de si el campio amb un nom contret l'ha afegir l'usuari que li passem
function modelComprovarUsuariId (PDO $connexio, string $nom, string $id) {
    try {
        $sql = "SELECT * FROM campeones WHERE id = :idChamp AND creator = :nomCreator";
            $statement = $connexio->prepare($sql);
            $statement->execute( 
                array(
                ':idChamp' => $id,
                ':nomCreator' => $nom
                )
            );

            if ($statement->rowCount() > 0){
                return "LaCreatEll";
            } else {
                return "NoLaCreatEll";
            }
    } catch(PDOException $e) {
        return "ErrorBD";
    }
}



// Elimina un campio de la base de dades segons el seu ID
function modelEliminarCampion(PDO $connexio, string $id) {
    try {
        $sql = "DELETE FROM campeones WHERE id = :idChamp";
        $statement = $connexio->prepare($sql);
        $statement->execute( 
            array(
            ':idChamp' => $id
            )
        );

        return "ELIMINAT";
            
    } catch(PDOException $e) {
        return "NoELIMINAT";
    }
}
?>