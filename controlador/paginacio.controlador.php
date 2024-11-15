<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once BASE_PATH . '/controlador/connexio.php';
require_once BASE_PATH . "/model/paginacio.model.php";

$connexio = connexio();

if(isset($_SESSION['usuari'])) {
    
    $nomUsuari = $_SESSION['usuari'];
    echo "Paginacio" . $nomUsuari;
    
    // Definim els champs per pàgina (Per defecte son 8)
    $champsPerPagina = isset($_COOKIE['champsPerPagina']) ? (int)$_COOKIE['champsPerPagina'] : 8; 

    // Mira quina paguina estem situats
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    // Calcular l'inici per a la consulta
    $inici = ($pagina > 1) ? ($pagina * $champsPerPagina - $champsPerPagina) : 0 ;

    // Obtenir els champs de la base de dades
    $campeons = selectUsuariLogiModel($connexio, $inici, $champsPerPagina, $nomUsuari);

    // Obtenir el numero total de campions
    $totalChamps = (int) contarChampionsUsuariLoginModel($connexio, $nomUsuari);

    // Calcular el nombre total de pàgines
    $numeroPagines = ($totalChamps >= 0) ? ceil($totalChamps / $champsPerPagina) : 1;

    // Comprovar si la pàgina és vàlida
    if ($pagina < 1 || $pagina > $numeroPagines) {
        header("Location: ?pagina=1");
        exit;
    }


} else {
    echo "Paginacio de TOTS els CHAMPS";
    
    // Definim els champs per pàgina (Per defecte son 8)
    $champsPerPagina = isset($_COOKIE['champsPerPagina']) ? (int)$_COOKIE['champsPerPagina'] : 8; 

    // Mira quina paguina estem situats
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    
    // Calcular l'inici per a la consulta
    $inici = ($pagina > 1) ? ($pagina * $champsPerPagina - $champsPerPagina) : 0 ;
    
    // Obtenir els champs de la base de dades
    $campeons = selectModel($connexio, $inici, $champsPerPagina);

    // Obtenir el numero total de campions
    $totalChamps = (int) contarChampionsModel($connexio);

    // Calcular el nombre total de pàgines
    $numeroPagines = ($totalChamps >= 0) ? ceil($totalChamps / $champsPerPagina) : 1;

    // Comprovar si la pàgina és vàlida
    if ($pagina < 1 || $pagina > $numeroPagines) {
        header("Location: ?pagina=1");
        exit;
    }
}
?>