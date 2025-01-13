<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crearEquip'])) {

}

$selectedChampions = isset($_POST['champions']) ? $_POST['champions'] : [];
$llistatChampions = [];

// URL de l'API
$url = "https://ddragon.leagueoflegends.com/cdn/14.20.1/data/es_ES/champion.json";

// Obtener llistat de array dels campeones
$jsonData = file_get_contents($url);
$data = json_decode($jsonData, true);

// Filtrar els campions per nom i tags
$llistatChampions = array_map(function($champion) {
    return [
        'id' => $champion['id'],
        'name' => $champion['name'],
        'tags' => $champion['tags'][0],
        'img' => $champion['image']['full']

    ];
}, $data['data']);

?>