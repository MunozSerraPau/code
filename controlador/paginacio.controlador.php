<?php
// Pau Muñoz Serra

require_once BASE_PATH . '/controlador/connexio.php';
require_once BASE_PATH . "/model/paginacio.model.php";

$connexio = connexio();

if(isset($_SESSION['usuari'])) {
    echo "Paginacio.php";
    $nomUsuari = $_SESSION['usuari'];
    $champsPerPagina = 8;  // Definim 6 articles per pàgina coma maxim

    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    $inici = ($pagina > 1) ? ($pagina * $champsPerPagina - $champsPerPagina) : 0 ;


    $campeons = selectUsuariLogiModel($connexio, $inici, $champsPerPagina, $nomUsuari);
    $totalChamps = (int) contarChampionsUsuariLoginModel($connexio, $nomUsuari);


    if ($totalChamps == 0) {
        $pagina = 0;
        $numeroPagines = ceil($totalChamps / $champsPerPagina);
    } else {
        $numeroPagines = ceil($totalChamps / $champsPerPagina);
    }


} else {
    echo "Paginacio.php HOLAAAAAAA";
    
    $champsPerPagina = 8;  // Definim 12 articles per pàgina coma maxim
  
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    
    $inici = ($pagina > 1) ? ($pagina * $champsPerPagina - $champsPerPagina) : 0 ;
    
    
    $campeons = selectModel($connexio, $inici, $champsPerPagina);
    $totalChamps = (int) contarChampionsModel($connexio);
    

    if ($totalChamps == 0) {
        $pagina = 0;
        $numeroPagines = ceil($totalChamps / $champsPerPagina);
    } else {
        $numeroPagines = ceil($totalChamps / $champsPerPagina);
    }
}
?>