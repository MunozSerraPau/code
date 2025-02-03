<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// URL de l'API
$url = "https://ddragon.leagueoflegends.com/cdn/14.20.1/data/es_ES/champion.json";


// $selectedChampions = isset($_POST['champions']) ? $_POST['champions'] : [];
$llistatChampions = [];


// Obtener llistat de array dels campeones
$jsonData = file_get_contents($url);
$data = json_decode($jsonData, true);

// Filtrar els campions per nom i tags
$llistatChampions = array_map(function($champion) {
    return [
        'id' => str_replace("'", " ", $champion['id']),
        'name' => str_replace("'", " ", $champion['name']),
        'tags' => $champion['tags'][0],
        'img' => $champion['image']['full']

    ];
}, $data['data']);

?>