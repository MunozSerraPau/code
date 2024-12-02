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

function mirarUsuariAdmin($username) {
    try {
        global $connexio;

        $sql = "SELECT COUNT(*) as esAdmin FROM usuaris WHERE nickname = :usuari";
        $usuaris = $connexio->prepare($sql);
        $usuaris ->execute(
            array(
                ":usuari" => $username
            )
        );
        $usuaris->execute();

        
        $result = $usuaris->fetch();
        if($result['esAdmin'] == 1) {
            return "EsAdmin";
        } else {
            return "NoEsAdmin";
        }

    } catch(PDOException $e) {
        return null;
    }
}

?>