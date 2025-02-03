<?php
// Pau Muñoz Serra
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();

function comprovarEquipId($idEquip) {
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

function obtenirInfoEquip($idEquip) {
    try {
        global $connexio;

        // Query para obtener los datos
        $sql = "SELECT 
                    e.nom_equip AS nom_equip, 
                    c.nameCampio AS nameCampio, 
                    c.tagsCampio AS tagsCampio,
                    c.imgCampio AS imgCampio
                FROM equips e
                JOIN equip_campio ec ON e.id = ec.idEquip
                JOIN campeons_api c ON ec.idCampio = c.id
                WHERE e.id = :idEquip";
                
        // Prepara y ejecuta la consulta
        $stmt = $connexio->prepare($sql);
        $stmt->execute(
            array(
                ":idEquip" => $idEquip
            )
        );

        // Retorna todos los resultados como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        return "ERROR: " . $e->getMessage();
    }
}


?>