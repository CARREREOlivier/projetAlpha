<?php
// Analyse la requête et redirige vers le bon composant
$uri = trim($_SERVER['REQUEST_URI'], '/');
$path = explode('/', $uri);

// Vérifie si la requête concerne l'API
if (isset($path[1]) && $path[1] === 'api') {
    require __DIR__ . '/backend/index.php';
} elseif (isset($path[1]) && $path[1] === 'admin') {
    require __DIR__ . '/frontend-admin/index.php';
} else {
    require __DIR__ . '/frontend-user/index.php';
}