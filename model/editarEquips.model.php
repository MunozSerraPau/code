<?php
// Pau Muñoz Serra
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();

function modelObtenirInfoEquip($idEquip) {
    try {
        global $connexio;
    
        $sql = "SELECT * FROM equips WHERE nomEquip = :nomEquip";
        $stmt = $connexio->prepare($sql);
        $resultat = $stmt->fetch();
        return $resultat;

    } catch (PDOException $e) {
        return "Error";
    }
}


?>