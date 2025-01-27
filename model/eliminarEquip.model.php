<?php 
// Pau Muñoz Serra
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();

// Comprovació de si el campio amb un nom concret l'ha afegir l'usuari que li passem
function modelComprovarUsuariIdEquip ($nom, $id) {
    try {
        global $connexio;
        $sql = "SELECT * FROM equips WHERE id = :idEquip AND creator = :nomCreator";
            $statement = $connexio->prepare($sql);
            $statement->execute( 
                array(
                ':idEquip' => $id,
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
function modelEliminarEquip($id) {
    try {
        global $connexio;
        $sql = "DELETE FROM equips WHERE id = :idEquip";
        $statement = $connexio->prepare($sql);
        $statement->execute( 
            array(
            ':idEquip' => $id
            )
        );

        return "ELIMINAT";
            
    } catch(PDOException $e) {
        return "NoELIMINAT";
    }
}
?>