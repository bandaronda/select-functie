<?php

class Database {
    private $host = 'localhost:3307';
    private $db   = 'Mensen';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    private $connection;

    public function __construct() {
        $this->connect();
    }

    public function connect() {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        try {
            $this->connection = new PDO($dsn, $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Databaseverbinding is gelukt.";
        } catch (PDOException $e) {
            die("Databaseverbinding mislukt: " . $e->getMessage());
        }
    }

    public function voegGebruikerToe($voornaam, $achternaam, $leeftijd) {
        $sql = "INSERT INTO gebruikers (naam, achternaam, leeftijd) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(1, $voornaam, PDO::PARAM_STR);
        $stmt->bindParam(2, $achternaam, PDO::PARAM_STR);
        $stmt->bindParam(3, $leeftijd, PDO::PARAM_INT);

        $stmt->execute();

        $stmt->closeCursor();
    }

    public function haalGebruikersOp($id = null) {
        if ($id !== null) {
            $sql = "SELECT * FROM gebruikers WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
        } else {
            $sql = "SELECT * FROM gebruikers";
            $stmt = $this->connection->query($sql);
        }

        $stmt->execute();
        $resultaat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $resultaat;
    }

    public function sluitVerbinding() {
        $this->connection = null;
    }
}

?>
