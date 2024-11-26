<?php
// Pau Muñoz Serra
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();

function selectObtenirTotsUsuaris() {
    try {
        global $connexio;

        $sql = "SELECT * FROM usuaris WHERE administrador <> 1";
        $usuaris = $connexio->prepare($sql);
        
        $usuaris->execute();

        $llistausuaris = $usuaris->fetchAll();
        return $llistausuaris;

    } catch(PDOException $e) {
        return null;
    }
}

?>