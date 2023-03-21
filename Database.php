<?php
class Database {
    private $conn; // La variable pour la connexion à la base de données

    /**
     * Constructeur pour établir une connexion à la base de données
     * Par défaut, l'hôte la base de données se trouve en local en se connectant
     * avec l'utilisateur root sans mot de passe à la b
     * 
     * @param string $host L'hôte de la base de données.
     * @param string $dbname Le nom de la base de données
     * @param string $username Le nom d'utilisateur pour se connecter à la base de données
     * @param string $password Le mot de passe pour se connecter à la base de données
     */
    public function __construct(string $host = "localhost", string $dbname = "your_dbname", string $username = "root", string $password = "") {
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        } catch(PDOException $e) {
            echo "Erreur de connexion: " . $e->getMessage();
        }
    }

    /**
     * Récupère les résultats d'une requête SELECT
     * @param string $query La requête SQL
     * @return array Les résultats de la requête sous forme de tableau
     */
    public function select($query): array {
        $stmt = $this->conn->prepare($query); // Prépare la requête
        $stmt->execute(); // Exécute la requête
        return $stmt->fetchAll(); // Renvoie tous les résultats sous forme de tableau
    }

    /**
     * Insère des données dans la base de données
     * @param string $query La requête SQL
     * @param array $data Les données à insérer
     * @return int L'ID de la dernière ligne insérée
     */
    public function insert($query, $data): int {
        $stmt = $this->conn->prepare($query); // Prépare la requête
        $stmt->execute($data); // Exécute la requête en utilisant les données fournies
        return $this->conn->lastInsertId(); // Renvoie l'ID de la dernière ligne insérée sous forme d'entier
    }

    /**
     * Met à jour les données dans la base de données
     * @param string $query La requête SQL
     * @param array $data Les données à mettre à jour
     * @return int Le nombre de lignes affectées par la requête
     */
    public function update($query, $data): int {
        $stmt = $this->conn->prepare($query); // Prépare la requête
        $stmt->execute($data); // Exécute la requête en utilisant les données fournies
        return $stmt->rowCount(); // Renvoie le nombre de lignes affectées par la requête sous forme d'entier
    }
    
    /**
     * Supprime des données dans la base de données
     * @param string $query La requête SQL
     * @param array $data Les données à utiliser pour la suppression
     * @return int Le nombre de lignes affectées par la requête
     */
    public function delete($query, $data): int {
        $stmt = $this->conn->prepare($query); // Prépare la requête
        $stmt->execute($data); // Exécute la requête en utilisant les données fournies
        return $stmt->rowCount(); // Renvoie le nombre de lignes affectées par la requête sous forme d'entier
    }
}