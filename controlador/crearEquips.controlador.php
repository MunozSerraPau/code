<?php
// Pau Muñoz Serra
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crearEquip'])) {

} 

$llistatChampions = [];

// URL de l'API
$url = "https://ddragon.leagueoflegends.com/cdn/14.20.1/data/es_ES/champion.json";

// Obtener llistat de array dels campeones
$jsonData = file_get_contents($url);
$data = json_decode($jsonData, true);

// Filtrar els campions per nom i tags
$llistatChampions = array_map(function($champion) {
    return [
        'name' => $champion['name'],
        'tags' => $champion['tags']
    ];
}, $data['data']);





// Recorrer campeones y mostrar en el formulario
foreach ($data['data'] as $champion) {
    echo '<div class="champion">';
    echo '<label>';
    echo '<input type="checkbox" name="champions[]" value="' . htmlspecialchars($champion['id']) . '">';
    echo '<strong>' . htmlspecialchars($champion['id']) . '</strong>';
    echo ' - Roles: ' . implode(', ', $champion['tags']); // Mostrar roles
    echo '</label>';
    echo '</div>';
}

?>