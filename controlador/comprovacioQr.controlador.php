<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; } else { header('Location: ' . BASE_URL . '/vista/login.vista.php'); }

require_once '../env.php';
require_once BASE_PATH . "/lib/QR-lib/vendor/autoload.php";

use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\QRCode;

// Verificar que s'ha pujat una imgatge
if (isset($_FILES['imatgeQR'])) {
    $options = new QROptions();

    try {
        $fileTmpPath = $_FILES['imatgeQR']['tmp_name'];
        $fileType = mime_content_type($fileTmpPath);

        // Verificar que es PNG
        if ($fileType !== 'image/png') {
            echo "<script>alert('❌ Error: Solo se permiten archivos PNG.'); window.location.href = '" . BASE_URL . "/vista/llistatEquips.vista.php';</script>";
            exit();
        }

        // Llegeix el QR de la imatge
        $qr = (new QRCode($options))->readFromFile($fileTmpPath);

        if (!empty($qr)) {
            // Verificar que el QR conté una URL amb el format desitjat
            $comprovacioDomini = '/^https:\/\/www\.paumunoz\.cat\/vista\/editarEquips\.vista\.php\?idEquip=\d+$/';
            $comprovacioLocalHost = '/^http:\/\/localhost\/code\/vista\/editarEquips\.vista\.php\?idEquip=\d+$/';

            if (preg_match($comprovacioDomini, $qr) || preg_match($comprovacioLocalHost, $qr)) {
                header('Location: ' . htmlspecialchars($qr));
                
                exit();
            } else {
                echo "<script>alert('❌ Error: La URL del codi QR no te el format esperat.'); window.location.href = '" . BASE_URL . "/vista/llistatEquips.vista.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('❌ Error: No s'ha pogut llegir el QR.'); window.location.href = '" . BASE_URL . "/vista/llistatEquips.vista.php';</script>";
            exit();
        }
    } catch (Exception $e) {
        echo "<script>
    alert('Se ha producido un error. Serás redirigido.');
    window.location.href = '" . BASE_URL . "/vista/llistatEquips.vista.php';
</script>";
exit();
        exit();
    }
} else {
    echo "<script>alert('⚠️ Error: No s'ha pujat cap arxiu.'); window.location.href = '" . BASE_URL . "/vista/llistatEquips.vista.php';</script>";
    exit();
}

?>