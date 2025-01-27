<?php 
// Pau Muñoz Serra
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();

// Seleccionar tots els equips de la base de dades
function obtenirTotsEquips() {
    try {
        global $connexio;

        // Query para obtener los datos
        $sql = "SELECT 
                    e.id AS id_equip,
                    e.nom_equip AS nom_equip, 
                    e.qrImage AS qr_image, 
                    e.creator AS creator, 
                    c.nameCampio AS nameCampio, 
                    c.tagsCampio AS tagsCampio
                FROM equips e
                JOIN equip_campio ec ON e.id = ec.idEquip
                JOIN campeons_api c ON ec.idCampio = c.id
                ORDER BY e.nom_equip";

                
        // Prepara y ejecuta la consulta
        $stmt = $connexio->prepare($sql);
        $stmt->execute();

        // Retorna todos los resultados como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        return "ERROR: " . $e->getMessage();
    }
}



?>