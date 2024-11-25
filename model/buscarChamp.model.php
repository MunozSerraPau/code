<?php 
// Pau Muñoz Serra
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();

/**
 * @Acctions - Obtenim el numero total els champs que hi ha a la base de dades d'un Usari concret amb un Name del champ concret.
 * 
 * 
 * @return - Retorna un numero amb el total de champs que hi ha.
 */
function contarChampionsBuscarLoguejatModel($usuari, $paraulaCerca) {
    try {
        global $connexio;
        $paraulaCerca= "%$paraulaCerca%";

        $sql = "SELECT COUNT(*) as total FROM campeones WHERE creator = :usuari AND name LIKE :paraulaCerca ";
        $stmt  = $connexio->prepare($sql);
        $stmt ->execute(
            array(
                ":usuari" => $usuari,
                ':paraulaCerca' => $paraulaCerca
            )
        );
        $stmt ->execute( );
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
        return $result ? (int)$result['total'] : 0;

    } catch(PDOException $e) {
        return 0;
    }
}

/**
 * @Acctions - Obtenim el numero total els champs que hi ha a la base de dades.
 * 
 * 
 * @return - Retorna un numero amb el total de champs que hi ha.
 */
function contarChampionsBuscarSenseLoguejarModel($paraulaCerca) {
    try {
        global $connexio;
        $paraulaCerca= "%$paraulaCerca%";

        $sql = "SELECT FOUND_ROWS() as total FROM campeones WHERE name LIKE :paraulaCerca";
        $totalCampeons = $connexio->prepare($sql);
        $totalCampeons ->execute(
            array(
                ':paraulaCerca' => $paraulaCerca
            )
        );
        $totalCampeons->execute();

        $totalCampeons = $totalCampeons->fetch()['total'];
            
        return $totalCampeons;

    } catch(PDOException $e) {
        return 0;
    }
}


/**
 * 
 * 
 */
function selectChampsBuscadorAmbLogin($inici, $champsPerPagines, $usuari, $ordre, $paraulaCerca) {
    try {
        global $connexio;
        $paraulaCerca= "%$paraulaCerca%";

        $ordreSQL = ($ordre == "Ascending") ? "ASC" : "DESC";

        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM campeones WHERE creator = :usuari AND name LIKE :paraulaCerca ORDER BY name $ordreSQL LIMIT $inici, $champsPerPagines";
        $campeons = $connexio->prepare($sql);

        $campeons->execute(
            array(
                ":usuari" => $usuari,
                ':paraulaCerca' => $paraulaCerca
            )
        );

        $champs = $campeons->fetchAll();
        return $champs;

    } catch(PDOException $e) {
        echo $e->getMessage();
        return null;
    }
}

/**
 * 
 * 
 */
function selectChampsBuscadorSenseLogin($inici, $champsPerPagines, $ordre, $paraulaCerca) {
    try {
        global $connexio;
        $paraulaCerca= "%$paraulaCerca%";

        // Determina l'ordre segons la selecció de l'usuari
        $ordreSQL = ($ordre == "Ascending") ? "ASC" : "DESC";

        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM campeones WHERE name LIKE :paraulaCerca ORDER BY name $ordreSQL	LIMIT $inici, $champsPerPagines";
        $campeons = $connexio->prepare($sql);
        $campeons->execute(
            array(
                ":paraulaCerca" => $paraulaCerca
            )
        );
        $campeons->execute();

        $champs = $campeons->fetchAll();
        return $champs;

    } catch(PDOException $e) {
        return null;
    }
}

?>