<?php 
// Pau Muñoz Serra
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();

// Comprovació de si el campio amb un nom contret l'ha afegir l'usuari que li passem
function modelComprovarUsuariId ($nom, $id) {
    try {
        global $connexio;
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
function modelEliminarCampion($id) {
    try {
        global $connexio;
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