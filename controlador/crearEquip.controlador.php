<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; }

require_once '../env.php';
require_once BASE_PATH . "/lib/QR-lib/vendor/autoload.php";
require_once BASE_PATH . "/model/crearEquip.model.php";

use chillerlan\QRCode\QRCode;

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if($_SERVER['REQUEST_METHOD'] == 'POST' && $data ) {
    $nomEquip = $data['nomEquip'];
    $champions = $data['champions'];
    $dataCreacio = date('Y-m-d H:i:s');

    // 1. Guardar l'equip
    $idEquip = guardarEquip($nomEquip, $nomUsuari, $dataCreacio);

    if (!preg_match('/^\d+$/', $idEquip)) {
        echo ('Error al guardar l\'equipo en la Base de Dades' . "Nom equip: " . $nomEquip . ". Nom Usuari: " . $nomUsuari . ". Data Creació: " . $dataCreacio);
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

    // Url amb el id passat per GET / para descodificar es urldecode($idEquip)
    $qr = $qrUrl . "?idEquip=" . urlencode($idEquip);

    // Generar el QR en format PNG
    $qrImg = (new QRCode)->render($qr);

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
    
    // S'HA DE PROVAR
    // echo ("Equip creat i QR generat correctament  <br />  <img src=" . (new QRCode)->render($qr) . " />");
}

?>