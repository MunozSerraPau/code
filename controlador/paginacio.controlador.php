<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


require_once BASE_PATH . "/model/paginacio.model.php";
// Inicialitzem les variables

$numeroPagines = 0;     // Nuemro de Pagines
$ordre = 'Ascending';   // Per defecte, l'ordenació serà ascendent
$pagina = 1;            // Pagina actual
$campeons = [];         // Array de campions


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscador'])) {
    $paraula = htmlspecialchars(trim($_POST['paraulaBuscador']));
    if ($paraula !== '') {
        if (isset($_SESSION['usuari'])) {
            mostrarBuscaLoguejat($paraula);
        } else {
            mostrarBuscaSenseLogin($paraula);
        }
    } else {
        if (isset($_SESSION['usuari'])) {
            mostrarTotsChampsLoguejat();
        } else {
            mostrarTotsChampsSenseLogin();
        }
    }
} else if (isset($_SESSION['usuari'])) {
    mostrarTotsChampsLoguejat();
} else {
    mostrarTotsChampsSenseLogin();
}


function mostrarTotsChampsLoguejat() {
    global $campeons;
    global $numeroPagines;
    global $ordre;
    global $pagina;
    $nomUsuari = $_SESSION['usuari'];

    echo "Paginacio" . $nomUsuari;

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

    // Obtenir el numero total de campions
    $totalChamps = (int) contarChampionsUsuariLoginModel($nomUsuari);

    // Calcular el nombre total de pàgines
    $numeroPagines = ($totalChamps >= 0) ? ceil($totalChamps / $champsPerPagina) : 1;

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

function mostrarTotsChampsSenseLogin() {
    global $campeons;
    global $numeroPagines;
    global $ordre;
    global $pagina;

    echo "Paginacio de TOTS els CHAMPS";

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
    
    // Calcular l'inici per a la consulta
    $inici = ($pagina > 1) ? ($pagina * $champsPerPagina - $champsPerPagina) : 0 ;
    
    // Obtenir els champs de la base de dades
    $campeons = selectModel($inici, $champsPerPagina, $ordre);

    // Obtenir el numero total de campions
    $totalChamps = (int) contarChampionsModel();

    // Calcular el nombre total de pàgines
    $numeroPagines = ($totalChamps >= 0) ? ceil($totalChamps / $champsPerPagina) : 1;

    // Comprovar si la pàgina és vàlida
    if ($pagina < 1 || $pagina > $numeroPagines) {
        $pagina = 1;
    }
}

function mostrarBuscaLoguejat($paraulaCerca) {
    global $campeons;
    global $numeroPagines;
    global $ordre;
    global $pagina;



    echo "Paginacio de la cerca Loguejat" . $paraulaCerca;
}

function mostrarBuscaSenseLogin($paraulaCerca) {
    global $campeons;
    global $numeroPagines;
    global $ordre;
    global $pagina;



    echo "Paginacio de la cerca Sense Loguejar" . $paraulaCerca;
}

?>