<?php 
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; }

require_once BASE_PATH . "/lib/QR-lib/vendor/autoload.php";
require_once BASE_PATH . "/model/llistatEquips.model.php";

use chillerlan\QRCode\QRCode;

// SELECT per obtenir tots els equips
$resutat = obtenirTotsEquips();
//echo var_dump($resutat);

if (is_string($resutat)) {
    die("Error al obtener los equipos: " . $resutat); // Muestra error y detiene ejecución
}

// Array per guardar les dades organitzades
$equipos = [];

// Comprobar si hay resultados
if (!empty($resutat)) {
    foreach ($resutat as $row) {
        $equipos[$row['nom_equip']]['id'] = $row['id_equip'];
        $equipos[$row['nom_equip']]['qr'] = (new QRCode)->render($row['qr_image']);
        $equipos[$row['nom_equip']]['creator'] = $row['creator'];
        $equipos[$row['nom_equip']]['campeones'][] = [
            'nombre' => $row['nameCampio'],
            'tags' => $row['tagsCampio']
        ];
    }
} else {
    $equipos = []; // Sin resultados, array vacío
}
    

?>