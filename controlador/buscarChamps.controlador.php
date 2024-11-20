<?php



if (isset($_POST['buscador'])) {
    // Obtener el valor ingresado por el usuario
    $textPerBuscar = trim(htmlspecialchars($_POST['buscador']));

    // Usar el texto para realizar acciones, por ejemplo, imprimirlo
    if (!empty($textPerBuscar)) {
        echo "Has buscat: " . $textPerBuscar;
    } else {
        echo "El campo esta buit.";
    }
}



?>