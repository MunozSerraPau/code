<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; }

require_once '../env.php';
require_once BASE_PATH . "/lib/QR-lib/vendor/autoload.php";
require_once BASE_PATH . "/model/crearEquip.model.php";

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if($_SERVER['REQUEST_METHOD'] == 'POST' && $data ) {
    $nomEquip = $data['nomEquip'];
    $champions = $data['champions'];
    $dataCreacio = date('Y-m-d H:i:s');

    // 1. Guardar l'equip
    $idEquip = guardarEquip($nomEquip, $nomUsuari, $dataCreacio);

    // 2. Comprovar i afegir campions si no existeixen
    foreach ($champions as $champion) {
        comprobarOAgregarCampeon($champion);
    }

    // 3. Relacionar l'equip amb els campions a la taula intermèdia
    foreach ($champions as $champion) {
        relacionarEquipCampio($idEquip, $champion['id']);
    }

    // 4. Generar el QR
    $qrData = json_encode([
        'nomEquip' => $nomEquip,
        'creador' => $nomUsuari,
        'dataCreacio' => $dataCreacio,
        'champions' => $champions
    ]);

    $options = new QROptions([
        'outputType' => QRCode::OUTPUT_IMAGE_PNG,
        'eccLevel' => QRCode::ECC_L,
    ]);
    $qrcode = new QRCode($options);
    $qrImage = $qrcode->render($qrData);

    // Guardar QR en una carpeta local
    $qrFileName = "qr_equip_$idEquip.png";
    $qrFilePath = BASE_PATH . "/qr_codes/" . $qrFileName;
    file_put_contents($qrFilePath, $qrImage);

    // Guardar el nombre del QR en la tabla "equips"
    actualizarQR($idEquip, $qrFileName);

    echo json_encode(['success' => true, 'message' => 'Equipo creado y QR generado correctamente']);
}

?>

<?php 
    /*
    // Pau Muñoz Serra
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    if (isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; }

    require_once '../env.php';
    require_once BASE_PATH . "/lib/QR-lib/vendor/autoload.php";
    require_once BASE_PATH . "/model/crearEquip.model.php";

    use chillerlan\QRCode\QRCode;
    use chillerlan\QRCode\QROptions;

    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $data) {
        $nomEquip = $data['nomEquip'];
        $champions = $data['champions'];
        $dataCreacio = date('Y-m-d H:i:s');

        try {
            $pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 1. Guardar el equipo
            $stmt = $pdo->prepare("INSERT INTO equips (nom_equip, creador, data_creacio) VALUES (:nomEquip, :creador, :dataCreacio)");
            $stmt->execute([':nomEquip' => $nomEquip, ':creador' => $nomUsuari, ':dataCreacio' => $dataCreacio]);
            $idEquip = $pdo->lastInsertId();

            // 2. Comprobar y agregar campeones si no existen
            $stmtCheckChampion = $pdo->prepare("SELECT id FROM campeons_api WHERE id = :id");
            $stmtInsertChampion = $pdo->prepare("INSERT INTO campeons_api (id, name, tags, imgChamp) VALUES (:id, :name, :tags, :imgChamp)");

            foreach ($champions as $champion) {
                $stmtCheckChampion->execute([':id' => $champion['id']]);
                if ($stmtCheckChampion->rowCount() === 0) {
                    $stmtInsertChampion->execute([
                        ':id' => $champion['id'],
                        ':name' => $champion['name'],
                        ':tags' => $champion['tags'],
                        ':imgChamp' => $champion['img']
                    ]);
                }
            }

            // 3. Relacionar equipo con campeones en la tabla intermedia
            $stmtInsertRelation = $pdo->prepare("INSERT INTO equip_campio (id_equip, id_champ) VALUES (:idEquip, :idChamp)");
            foreach ($champions as $champion) {
                $stmtInsertRelation->execute([':idEquip' => $idEquip, ':idChamp' => $champion['id']]);
            }

            // 4. Generar el QR
            $qrData = json_encode([
                'nomEquip' => $nomEquip,
                'creador' => $nomUsuari,
                'dataCreacio' => $dataCreacio,
                'champions' => $champions
            ]);

            $options = new QROptions([
                'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                'eccLevel' => QRCode::ECC_L,
            ]);
            $qrcode = new QRCode($options);
            $qrImage = $qrcode->render($qrData);

            // Guardar QR en una carpeta local
            $qrFileName = "qr_equip_$idEquip.png";
            $qrFilePath = BASE_PATH . "/qr_codes/" . $qrFileName;
            file_put_contents($qrFilePath, $qrImage);

            // Guardar el nombre del QR en la tabla "equips"
            $stmtUpdateQR = $pdo->prepare("UPDATE equips SET qr_image = :qrImage WHERE id = :idEquip");
            $stmtUpdateQR->execute([':qrImage' => $qrFileName, ':idEquip' => $idEquip]);

            echo json_encode(['success' => true, 'message' => 'Equipo creado y QR generado correctamente']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
    */
?>
