<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once BASE_PATH . "/model/paginacioChamps.model.php";
require_once BASE_PATH . "/model/buscarChamp.model.php";


// Inicialitzem les variables
$numeroPagines = 0;     // Nuemro de Pagines
$ordre = 'Ascending';   // Per defecte, l'ordenació serà ascendent
$pagina = 1;            // Pagina actual
$campeons = [];         // Array de campions


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscador'])) {

    if (isset($_SESSION['usuari'])) {
        $paraulaBuscar = htmlspecialchars(trim($_POST['paraulaBuscador']));
        setcookie('paraulaBuscador', $paraulaBuscar, time() + 3600 * 24 * 30, "/");
        
        mostrarChampsLoguejat($paraulaBuscar);
    } else {
        $paraulaBuscar = htmlspecialchars(trim($_POST['paraulaBuscador']));
        setcookie('paraulaBuscador', $paraulaBuscar, time() + 3600 * 24 * 30, "/");
        mostrarChampsSenseLogin($paraulaBuscar);
    }
} else {
    if (isset($_SESSION['usuari'])) {
        $paraulaBuscar = isset($_COOKIE['paraulaBuscador']) ? htmlspecialchars($_COOKIE['paraulaBuscador']) : '';
        mostrarChampsLoguejat($paraulaBuscar);
    } else {
        $paraulaBuscar = isset($_COOKIE['paraulaBuscador']) ? htmlspecialchars($_COOKIE['paraulaBuscador']) : '';
        mostrarChampsSenseLogin($paraulaBuscar);
    }
}



function mostrarChampsLoguejat($paraula) {
    global $campeons;
    global $numeroPagines;
    global $ordre;
    global $pagina;
    $nomUsuari = $_SESSION['usuari'];
    

    if (isset($_COOKIE['ordre'])) {
        // Si la cookie existeix, la utilitzem per ordenar
        $ordre = $_COOKIE['ordre'];
    }

    // Si l'usuari canvia l'ordre mitjançant el formulari, actualitzem la cookie
    if (isset($_POST['ordre'])) {
        $ordre = $_POST['ordre'];
        // Guardem la selecció a la cookie (expira en 30 dies)
        setcookie('ordre', $ordre, time() + (30 * 24 * 60 * 60), '/');
    }

    // Si el formulari ha enviat un valor per 'champsPerPagina', actualitzem la cookie
    if (isset($_GET['champsPerPagina'])) {
        $champsPerPagina = (int)$_GET['champsPerPagina'];
        if(in_array($champsPerPagina, [8, 12, 16, 20])) {
            setcookie('champsPerPagina', $champsPerPagina, time() + 3600 * 24 * 30, "/"); // Valida la cookie durant 30 dies
        } else {
            $champsPerPagina = isset($_COOKIE['champsPerPagina']) ? (int)$_COOKIE['champsPerPagina'] : 8;
        }
        
    } else {
        // Si no s'ha enviat cap valor, utilitzem la cookie si existeix, o el valor per defecte
        $champsPerPagina = isset($_COOKIE['champsPerPagina']) ? (int)$_COOKIE['champsPerPagina'] : 8;
    }



    if ($paraula !== '') {
        // Obtenir el numero total de campions
        $totalChamps = (int) contarChampionsBuscarLoguejatModel($nomUsuari, $paraula);

        // Calcular el nombre total de pàgines
        $numeroPagines = ($totalChamps >= 1) ? ceil($totalChamps / $champsPerPagina) : 1;

        // Mira quina paguina estem situats
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

        if ($pagina < 1 || $pagina > $numeroPagines) {
            $pagina = 1;
        }

        // Calcular l'inici per a la consulta
        $inici = ($pagina > 1) ? ($pagina * $champsPerPagina - $champsPerPagina) : 0 ;

        // Obtenir els champs de la base de dades
        $campeons = selectChampsBuscadorAmbLogin($inici, $champsPerPagina, $nomUsuari, $ordre, $paraula);
    } else {
        // Obtenir el numero total de campions
        $totalChamps = (int) contarChampionsUsuariLoginModel($nomUsuari);

        // Calcular el nombre total de pàgines
        $numeroPagines = ($totalChamps >= 1) ? ceil($totalChamps / $champsPerPagina) : 1;

        // Mira quina paguina estem situats
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

        if ($pagina < 1 || $pagina > $numeroPagines) {
            $pagina = 1;
        }

        // Calcular l'inici per a la consulta
        $inici = ($pagina > 1) ? ($pagina * $champsPerPagina - $champsPerPagina) : 0 ;

        // Obtenir els champs de la base de dades
        $campeons = selectUsuariLogiModel($inici, $champsPerPagina, $nomUsuari, $ordre);
    }
    
}

function mostrarChampsSenseLogin($paraula) {
    global $campeons;
    global $numeroPagines;
    global $ordre;
    global $pagina;


    if (isset($_COOKIE['ordre'])) {
        // Si la cookie existeix, la utilitzem per ordenar
        $ordre = $_COOKIE['ordre'];
    }
    
    // Si l'usuari canvia l'ordre mitjançant el formulari, actualitzem la cookie
    if (isset($_POST['ordre'])) {
        $ordre = $_POST['ordre'];
        // Guardem la selecció a la cookie (expira en 30 dies)
        setcookie('ordre', $ordre, time() + (30 * 24 * 60 * 60), '/');
    }

    // Si el formulari ha enviat un valor per 'champsPerPagina', actualitzem la cookie
    if (isset($_GET['champsPerPagina'])) {
        $champsPerPagina = (int)$_GET['champsPerPagina'];
        if(in_array($champsPerPagina, [8, 12, 16, 20])) {
            setcookie('champsPerPagina', $champsPerPagina, time() + 3600 * 24 * 30, "/"); // Valida la cookie durant 30 dies
        } else {
            $champsPerPagina = isset($_COOKIE['champsPerPagina']) ? (int)$_COOKIE['champsPerPagina'] : 8;
        }
        
    } else {
        // Si no s'ha enviat cap valor, utilitzem la cookie si existeix, o el valor per defecte
        $champsPerPagina = isset($_COOKIE['champsPerPagina']) ? (int)$_COOKIE['champsPerPagina'] : 8;
    }

    // Mira quina paguina estem situats
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    
    
    
    if ($paraula !== '') {

        $totalChamps = (int) contarChampionsBuscarSenseLoguejarModel($paraula);

        // Calcular el nombre total de pàgines
        $numeroPagines = ($totalChamps >= 1) ? ceil($totalChamps / $champsPerPagina) : 1;

        // Comprovar si la pàgina és vàlida
        if ($pagina < 1 || $pagina > $numeroPagines) {
            $pagina = 1;
        }

        // Calcular l'inici per a la consulta
        $inici = ($pagina > 1) ? ($pagina * $champsPerPagina - $champsPerPagina) : 0 ;

        $campeons = selectChampsBuscadorSenseLogin($inici, $champsPerPagina, $ordre, $paraula);


    } else {
        // Calcular l'inici per a la consulta
        $inici = ($pagina > 1) ? ($pagina * $champsPerPagina - $champsPerPagina) : 0 ;
        
        // Obtenir els champs de la base de dades
        $campeons = selectModel($inici, $champsPerPagina, $ordre);

        // Obtenir el numero total de campions
        $totalChamps = (int) contarChampionsModel();

        // Calcular el nombre total de pàgines
        $numeroPagines = ($totalChamps >= 1) ? ceil($totalChamps / $champsPerPagina) : 1;

        // Comprovar si la pàgina és vàlida
        if ($pagina < 1 || $pagina > $numeroPagines) {
            $pagina = 1;
        }
    }    
}

?>