<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


require_once BASE_PATH . "/model/paginacio.model.php";
require_once BASE_PATH . "/controlador/connexio.php";
$connexio = connexio();


if(isset($_SESSION['usuari'])) {
    
    $nomUsuari = $_SESSION['usuari'];
    echo "Paginacio" . $nomUsuari;

    // Per defecte, l'ordenació serà ascendent
    $ordre = 'Ascending'; 

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
    $totalChamps = (int) contarChampionsUsuariLoginModel($connexio, $nomUsuari);

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
    $campeons = selectUsuariLogiModel($connexio, $inici, $champsPerPagina, $nomUsuari, $ordre);


} else {
    echo "Paginacio de TOTS els CHAMPS";
    
    // Per defecte, l'ordenació serà ascendent
    $ordre = 'Ascending'; 

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
    $campeons = selectModel($connexio, $inici, $champsPerPagina, $ordre);

    // Obtenir el numero total de campions
    $totalChamps = (int) contarChampionsModel($connexio);

    // Calcular el nombre total de pàgines
    $numeroPagines = ($totalChamps >= 0) ? ceil($totalChamps / $champsPerPagina) : 1;

    // Comprovar si la pàgina és vàlida
    if ($pagina < 1 || $pagina > $numeroPagines) {
        $pagina = 1;
    }
}
?>