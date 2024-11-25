<?php 
// Pau Muñoz Serra
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();


// Elimina un campio de la base de dades segons el seu ID
function modelEliminarUsuari($username) {
    try {
        global $connexio;
        $sql = "DELETE FROM usuaris WHERE nickname = :username";
        $statement = $connexio->prepare($sql);
        $statement->execute( 
            array(
            ':username' => $username
            )
        );

        return "ELIMINAT";
            
    } catch(PDOException $e) {
        return "NoELIMINAT";
    }
}
?>