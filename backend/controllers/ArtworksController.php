<?php

namespace Controllers;

use PDO;

class ArtworksController {
    private $db;

    public function __construct() {
        // Initialiser la connexion à la base de données
        require_once __DIR__ . '/../config/database.php';
        $this->db = getDatabaseConnection();
    }

    public function getAllArtworks() {
        try {
            // Préparer et exécuter la requête SQL
            $query = $this->db->prepare("SELECT * FROM Artworks WHERE isVisible = TRUE ORDER BY date DESC");
            $query->execute();

            // Récupérer les résultats
            $artworks = $query->fetchAll(PDO::FETCH_ASSOC);
            return [
                'status' => 'success',
                'data' => $artworks
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}

?>
