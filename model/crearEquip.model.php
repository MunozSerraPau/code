<?php

// Pau Muñoz Serra
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();


// Guardar l'equip i les dades a la base de dades
function guardarEquip($nomEquip, $creador, $dataCreacio) {
    try {
        // Validación de entrada básica
        if (empty($nomEquip) || empty($creador) || empty($dataCreacio)) {
            throw new InvalidArgumentException("Todos los campos son obligatorios.");
        }

        global $connexio;

        $sql = "INSERT INTO equips (nom_equip, creator, data_creacio, qrImage) VALUES (:nomEquip, :creador, :dataCreacio, :qrImage)";
        $stmt = $connexio->prepare($sql);
        $stmt -> execute(
            array (
                ':nomEquip' => $nomEquip, 
                ':creador' => $creador, 
                ':dataCreacio' => $dataCreacio,
                ':qrImage' => null
            )
        );
        return $connexio->lastInsertId();
    } catch (PDOException $e) {
        // Registro de error
        return("Error al guardar el equipo: " . $e->getMessage());

        // Opcional: puedes devolver el mensaje de error en desarrollo
        // return "Error: " . $e->getMessage();

    } catch (InvalidArgumentException $e) {
        return("Datos inválidos: " . $e->getMessage());
    }
}


// Comprovar si el campio ja existeix a la base de dades, si no existeix l'afegim
function comprobarOAgregarCampeon($champion) {
    try {
        global $connexio;

        $sql = "SELECT id FROM campeons_api WHERE nameCampio = :name";
        $stmt = $connexio->prepare($sql);
        $stmt->execute(
            array (
                ':name' => $champion['name']
            )
        );
                
        if ($stmt->rowCount() === 0) {
            $sql_2 = "INSERT INTO campeons_api (nameCampio, tagsCampio, imgCampio) VALUES (:name, :tags, :imgChamp)";
            $stmtp = $connexio->prepare($sql_2);
            $stmtp-> execute(
                array (
                    ':name' => $champion['name'],
                    ':tags' => $champion['tags'],
                    ':imgChamp' => $champion['img']
                )
            );
        }
        return('1');
    } catch(PDOException $e) {
        return("ERROR: " . $e->getMessage()) ;
    }

}


// Relacionar el equip amb el campio a la taula intermèdia
function relacionarEquipCampio($idEquip, $nameChamp) {
    try {
        global $connexio;

        // Obtenir el ID del campió a parti del seu nom
        $sqlSelect = "SELECT id FROM campeons_api WHERE nameCampio = :nameChamp";
        $stmtSelect = $connexio->prepare($sqlSelect);
        $stmtSelect->execute([':nameChamp' => $nameChamp]);

        // Obtenim el resultat
        $idChamp = $stmtSelect->fetchColumn();

        // Verificar si hem trobat el campió
        if (!$idChamp) {
            throw new Exception("No se encontró el campeón con el nombre '$nameChamp'.");
        }


        // OPCIÓ 2 TOT EN UNA MATEIXA SENTENCIA
        // $sql = "INSERT INTO equip_campio (idEquip, idCampio) VALUES (:idEquip, (SELECT id FROM campeons_api WHERE nameCampio = :nameChamp))";

        // Insertar la relacció en la taula intermitja
        $sqlInsert = "INSERT INTO equip_campio (idEquip, idCampio) VALUES (:idEquip, :idChamp)";
        $stmtInsert = $connexio->prepare($sqlInsert);
        $stmtInsert->execute([
            ':idEquip' => $idEquip,
            ':idChamp' => $idChamp,
        ]);

        return '1';
    } catch (PDOException $e) {
        return "ERROR: " . $e->getMessage();
    } catch (Exception $e) {
        return "ERROR: " . $e->getMessage();
    }
}

// Afegir el el nom del qr a la taula de Equips
function actualizarQR($idEquip, $qrFileName) {
    try {
        global $connexio;

        $sql = "UPDATE equips SET qrImage = :qrImage WHERE id = :idEquip";
        $stmt = $connexio->prepare($sql);
        $stmt -> execute(
            array (
                ':qrImage' => $qrFileName, 
                ':idEquip' => $idEquip
            )
        );

        return '1';
    } catch(PDOException $e) {
        return "ERROR: " . $e->getMessage();
    }
}

?>