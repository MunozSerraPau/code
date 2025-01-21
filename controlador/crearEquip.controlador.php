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
    
    
    
    // 4. Generar el QR
    $qrUrl = "http://localhost/code/vista/editarEquips.vista.php";

    $qr = ($qrUrl . "?idEquip=" . urldecode($idEquip));
    $qrImg = (new QRCode)->render($qr);
    $qrFileName = "qr_equip_$idEquip.png";
    $qrFilePath = BASE_PATH . "/vista/qr/" . $qrFileName;
    
    // Guardar el nombre del QR en la tabla "equips"
    if (actualizarQR($idEquip, $qrFileName) == null) {
        echo ('Error en guardar el QR a la base de dades');
        exit;
    }

    // S'HA DE PROVAR
    echo ("Equip creat i QR generat correctament  <br />  <img src=" . (new QRCode)->render($qr) . " />");
}

?>