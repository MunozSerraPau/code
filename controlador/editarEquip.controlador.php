<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) { session_start(); }

if ( isset($_SESSION['usuari'])) {  $nomUsuari = $_SESSION['usuari'];  } else { header('Location: ' . BASE_URL . '/vista/login.vista.php'); }

require_once BASE_PATH . "/model/editarEquips.model.php";

$error = "<br>";

if($_GET['idEquip'] !== null) {
    $idEquip = $_GET['idEquip'];
    echo $idEquip;
    if(comprovarEquipId($idEquip) !== null) {
        $equip = obtenirInfoEquip($idEquip);

        echo "----------------------------";
        echo json_encode($equip);
        echo "----------------------------";


        if($equip !== null) {
            

        } else {
            $error = "No s'ha pogut obtenir la informació de l'equip";
        }

    } else {
        $error = "No existeix cap equip amb la id passada";
    }
} else {
    $error = "No s'ha passat cap id d'equip";
}

?>