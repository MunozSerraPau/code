<?php

// Pau Muñoz Serra
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();


// Guardar l'equip i les dades a la base de dades
function guardarEquip($nomEquip, $creador, $dataCreacio) {
    try {
        global $connexio;

        $sql = "INSERT INTO equips (nom_equip, creador, data_creacio) VALUES (:nomEquip, :creador, :dataCreacio)";
        $stmt = $connexio->prepare($sql);
        $stmt -> execute(
            array (
                ':nomEquip' => $nomEquip, 
                ':creador' => $creador, 
                ':dataCreacio' => $dataCreacio
            )
        );

        return $connexio->lastInsertId();
    } catch(PDOException $e) {
        return null;
    }
}


// Comprovar si el campio ja existeix a la base de dades, si no existeix l'afegim
function comprobarOAgregarCampeon($champion) {
    try {
        global $connexio;

        $sql = "SELECT id FROM campeons_api WHERE name = :name";
        $stmt = $connexio->prepare($sql);
        $stmt->execute(
            array (
                ':name' => $champion['name']
            )
        );
                
        if ($stmt->rowCount() === 0) {
            $sql_2 = "INSERT INTO campeons_api (name, tags, imgChamp) VALUES (:name, :tags, :imgChamp)";
            $stmtp = $connexio->prepare($sql_2);
            $stmtp-> execute(
                array (
                    ':name' => $champion['name'],
                    ':tags' => $champion['tags'],
                    ':imgChamp' => $champion['img']
                )
            );
        }
    } catch(PDOException $e) {
        return null;
    }

}


// Relacionar el equip amb el campio
function relacionarEquipCampio($idEquip, $idChamp) {
    try {
        global $connexio;

        $sql = "INSERT INTO equip_campio (id_equip, id_champ) VALUES (:idEquip, :idChamp)";
        $stmt = $connexio->prepare($sql);
        $stmt -> execute(
            array (
                ':idEquip' => $idEquip, 
                ':idChamp' => $idChamp
            )
        );
    } catch(PDOException $e) {
        return null;
    }
}


// Afegir el el nom del qr a la taula de Equips
function actualizarQR($idEquip, $qrFileName) {
    try {
        global $connexio;

        $sql = "UPDATE equips SET qr_image = :qrImage WHERE id = :idEquip";
        $stmt = $connexio->prepare($sql);
        $stmt -> execute(
            array (
                ':qrImage' => $qrFileName, 
                ':idEquip' => $idEquip
            )
        );
    } catch(PDOException $e) {
        return null;
    }

}

?>