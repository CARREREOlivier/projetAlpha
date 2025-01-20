<?php

require 'vendor/autoload.php'; // Chargement des dépendances si vous utilisez Composer
require 'config/database.php';

// Chargement des routes
require 'routes/users.php';
require 'routes/artworks.php';

// Configuration de l'application
use Slim\App;

$app = new App();

// Middleware (par ex. pour la gestion CORS)
$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// Route pour récupérer toutes les oeuvres
$app->get('/artworks', function ($request, $response) {
    require_once 'controllers/ArtworksController.php';
    $controller = new ArtworksController();
    $artworks = $controller->getAllArtworks();
    return $response->withJson($artworks);
});

// Exécution de l'application
$app->run();
