<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) { session_start(); }

require_once '../env.php';
require_once BASE_PATH . "/lib/QR-lib/vendor/autoload.php";
require_once BASE_PATH . "/model/editarEquips.model.php";

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ( isset($_SESSION['usuari'])) {  $nomUsuari = $_SESSION['usuari'];  } else { header('Location: ' . BASE_URL . '/vista/login.vista.php'); }

$error = "<br>";


if($_SERVER['REQUEST_METHOD'] == 'POST' && $data ) {
    $nomEquip = $data['nomEquip'];
    $champions = $data['champions'];
    $dataCreacio = date('Y-m-d H:i:s');

    // 1. Guardar l'equip
    $idEquip = guardarEquip($nomEquip, $nomUsuari, $dataCreacio);

    if (!preg_match('/^\d+$/', $idEquip)) {
        echo ("Error al guardar l\'equipo en la Base de Dades. Nom equip: " . $nomEquip . ". Ja existeix un equip amb aquest nom.");
        exit;
    }



    // 2. Comprovar i afegir campions si no existeixen
    foreach ($champions as $champion) {
        $comprovacio = comprobarOAgregarCampeon($champion);

        if (!preg_match('/^\d+$/', $comprovacio)) {
            echo ('Error al comprovar i afegir els campions si no existeixen: ' . $comprovacio);
            exit;
        }
    }

    
    // 3. Relacionar l'equip amb els campions a la taula intermèdia
    foreach ($champions as $champion) {
        $comprovacio = relacionarEquipCampio($idEquip, $champion['name']);
        
        if (!preg_match('/^\d+$/', $comprovacio)) {
            echo ('Error en relacionar els campions amb l\'equip: ' . $comprovacio);
            exit;
        }
    }
    
    
    // 4. Generar el QR //
    // Url de la vista per editar l'equip
    $qrUrl = "http://localhost/code/vista/editarEquips.vista.php";

    $options = new QROptions( properties: [
        'outputType' => QRCode::OUTPUT_IMAGE_PNG,
    ]);

    // Url amb el id passat per GET / para descodificar es urldecode($idEquip)
    $qr = $qrUrl . "?idEquip=" . urlencode($idEquip);

    // Generar el QR en format PNG
    $qrImg = (new QRCode(options: $options))->render($qr);

    // Guardar el QR a la la taula "equips"
    $comprovacio = actualizarQR($idEquip, $qr);

    // Comprovem si s'ha guardat correctament o no
    if (preg_match('/^\d+$/', $comprovacio)) {
        echo "<img src=".$qrImg." width='250px' height='250px' />";
        exit;
    } else {
        echo ('Error en guardar el QR a la base de dades: ' . $comprovacio);
        exit;
    }
    
} elseif ($_GET['idEquip'] !== null) {
    $idEquip = $_GET['idEquip'];
    echo $idEquip;
    if(comprovarEquipId($idEquip) !== null) {
        $equip = obtenirInfoEquip($idEquip);
        if($equip === null) {
            $error = "No s'ha pogut obtenir la informació de l'equip";
        }
    } else {
        $error = "No existeix cap equip amb la id passada";
    }
} else {
    $error = "No s'ha passat cap id d'equip";
}

?>