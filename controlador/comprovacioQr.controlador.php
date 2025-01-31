<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; } else { header('Location: ' . BASE_URL . '/vista/login.vista.php'); }

require_once '../env.php';
require_once BASE_PATH . "/lib/QR-lib/vendor/autoload.php";

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\QROptions;
// use chillerlan\QRCode\QRCodeReader;

// Verificar si se ha subido un archivo
if (isset($_FILES['qrImage']) && $_FILES['qrImage']['error'] === UPLOAD_ERR_OK) {
    
    $fileTmpPath = $_FILES['qrImage']['tmp_name'];
    $fileType = mime_content_type($fileTmpPath);

    // Verificar que el archivo sea PNG
    if ($fileType !== 'image/png') {
        die("Error: Solo se permiten archivos PNG.");
    }

    // Leer y decodificar el código QR
    $qrcode = new QRCode();
    $decodedText = $qrcode->render(file_get_contents($fileTmpPath));

    if ($decodedText) {
        echo "Contenido del QR: " . htmlspecialchars($decodedText);
    } else {
        echo "Error: No se pudo leer el código QR.";
    }
} else {
    echo "Error: No se subió ningún archivo.";
}

?>