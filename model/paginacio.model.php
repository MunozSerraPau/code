<?php 
// Pau Muñoz Serra


// require_once BASE_PATH . "/controlador/connexio.php";
// $connexio = connexio();


/**
 * @Acctions - Obtenim tots els champs de la base de dades i els guardem a una array.
 * 
 * 
 * @connexio - La conexio amb la base de dades
 * @inici - El inici del registre d'on agaferem els champs
 * @champsPerPagines - son la quantitat de registres que agaferem a aprtir de l'inici
 * 
 * @return - Retorna una array amb tots els registres de champs de la base de dades o "null" si hi ha algun porblema.
 */
function selectModel(PDO $connexio, int $inici, int $champsPerPagines, string $ordre) {
    
    try {

        // Determina l'ordre segons la selecció de l'usuari
        $ordreSQL = ($ordre == "Ascending") ? "ASC" : "DESC";

        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM campeones ORDER BY name $ordreSQL	LIMIT $inici, $champsPerPagines";
        $campeons = $connexio->prepare($sql);

        $campeons->execute();

        $champs = $campeons->fetchAll();
        return $champs;

    } catch(PDOException $e) {
        return null;
    }
}

/**
 * @Acctions - Obtenim el numero total els champs que hi ha a la base de dades.
 * 
 * 
 * @connexio - La conexio amb la base de dades
 * 
 * @return - Retorna un numero amb el total de champs que hi ha.
 */
function contarChampionsModel(PDO $connexio) :int{
    try {
        $sql = "SELECT FOUND_ROWS() as total FROM campeones";
        $totalCampeons = $connexio->prepare($sql);
        $totalCampeons->execute();

        $totalCampeons = $totalCampeons->fetch()['total'];
            
        return $totalCampeons;

    } catch(PDOException $e) {
        return 0;
    }
}

/**
 * @Acctions - Obtenim tots els champs de la base de dades que entren en aquella paguina que siguin del usuari que li passem i els guardem a una array.
 * 
 * 
 * @connexio - La conexio amb la base de dades
 * @inici - El inici del registre d'on agaferem els chamsp
 * @champsPerPagines - son la quantitat de registres que agaferem a aprtir de l'inici
 * @usuari - es l'usuari del que volem agafar els seus registres
 * 
 * @return - Retorna una array amb tots els registres de champs de la base de dades o "null" si hi ha algun porblema.
 */
function selectUsuariLogiModel(PDO $connexio, int $inici, int $champsPerPagines, string $usuari, $ordre) {
    
    try {
        $ordreSQL = ($ordre == "Ascending") ? "ASC" : "DESC";

        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM campeones WHERE creator = :usuari ORDER BY name $ordreSQL LIMIT $inici, $champsPerPagines";
        $campeons = $connexio->prepare($sql);

        $campeons->execute(
            array(
                ":usuari" => $usuari
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
 * @Acctions - Obtenim el numero total els champs que hi ha a la base de dades d'un Usari concret.
 * 
 * 
 * @connexio - La conexio amb la base de dades
 * 
 * @return - Retorna un numero amb el total de champs que hi ha.
 */
function contarChampionsUsuariLoginModel(PDO $connexio, string $usuari) :int{
    try {
        $sql = "SELECT COUNT(*) as total FROM campeones WHERE creator = :usuari";
        $stmt  = $connexio->prepare($sql);
        $stmt ->execute(
            array(
                ":usuari" => $usuari
            )
        );
        $stmt ->execute( );
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
        return $result ? (int)$result['total'] : 0;

    } catch(PDOException $e) {
        return 0;
    }
}

?>