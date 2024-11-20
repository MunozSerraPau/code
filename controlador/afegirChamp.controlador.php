<?php 
// Pau Muñoz Serra

if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once BASE_PATH . "/model/afegirChamp.model.php";
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();


// Error per guardar en cas de algun espai buit
$error = "<br>"; 
echo "->";
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['usuari']) && isset($_POST['insert'])) {
    echo "0";
    // obtenim les dades del formulari
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
        echo "1";
        if(isset($_SESSION['usuari'])){  $nomUsuari = $_SESSION['usuari'];  }
        echo $nomUsuari;
        // mirem que no estigui duplicat
        if (modelComprovarNom($connexio, $nom) == "ChampNoDuplicat") {
            echo "2";
            // afegim el nou campio
            $afegirChamp = modelAfegirCampio($connexio, $nom, $descripcio, $recurs, $rol, $nomUsuari);
            if($afegirChamp === "SiCreat") {
                echo "3";
                // OPCIO 1 (treu tot un alert i ja esta)
                unset($_POST['nomCampio']);
                unset($_POST['descripcio']);
                unset($_POST['resource']);
                unset($_POST['role']);
               $error = "ChampCreat";


                // OPCIO 2 (Alert i retornar a la pagina principal)
                /* echo '<script> alert("Campio CREAT!!"); window.location.href = "../"; </script>'; */
                
            }
        } else {
            $error = "Error el NOM del campio ja EXISTEIX<br>";
        }
        
       
    }
}


?>