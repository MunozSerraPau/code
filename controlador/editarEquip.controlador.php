<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (isset($_SESSION['usuari'])) { $nomUsuari = $_SESSION['usuari']; } else { header('Location: ' . BASE_URL . '/vista/login.vista.php'); }

require_once BASE_PATH . "/model/editarEquips.model.php";

$error = "<br>";





?>