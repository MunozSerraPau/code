<?php 
// Pau Muñoz Serra

require_once BASE_PATH . "/model/afegirChamp.model.php";
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();


// Error per guardar en cas de algun espai buit
$error = "<br>"; 

if ($_SERVER["REQUEST_METHOD"] == "POST" /* && !empty($_SESSION['usuari']) */ ) {

    $nom = htmlspecialchars($_POST['nomCampio']);
    $descripcio = htmlspecialchars($_POST['descripcio']);
    $recurs = htmlspecialchars($_POST['resource']);
    $rol = htmlspecialchars($_POST['role']);

    // fem comprovacións de si esta tot be o no
    if(empty($nom)) {
        $error .= "Error no has ficat el NOM<br>";
    } 
    if (empty($descripcio)) {
        $error .= "Error no has ficat DESCRIPCIO<br>";
    } 
    if (empty($recurs)) {
        $error .= "Error no has ficat el RECURS<br>";
    } 
    if (empty($rol) || $rol === "-----") {
        $error .= "Error no has ficat el seu ROLE<br>";
    } 

    if($error === "<br>") {
        // obtenir el nostre NickName
        if(isset($_SESSION['usuari'])){  $nomUsuari = $_SESSION['usuari'];  }
        $nomUsuari = "Pau";
        // mirem que no estigui duplicat
        if (modelComprovarNom($connexio, $nom) == "ChampNoDuplicat") {
            // afegim el nou campio
            $afegirChamp = modelAfegirCampio($connexio, $nom, $descripcio, $recurs, $rol, $nomUsuari);
            if($afegirChamp === "SiCreat") {
                // salta error si esta duplicat
                $error = "ChampCreat";
            }
        } else {
            $error = "Error el NOM del campio ja EXISTEIX<br>";
        }
        
       
    }
}


?>