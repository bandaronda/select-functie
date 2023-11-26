<?php
include 'db.php';

$database = new Database();

// Voeg een gebruiker toe voor demonstratie
$database->voegGebruikerToe("Voornaam", "Achternaam", 25);

// Haal alle gebruikers op
$gebruikers = $database->haalGebruikersOp();

// Toon de gebruikers in een tabel
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Achternaam</th>
            <th>Leeftijd</th>
            <th>Bewerken</th>
            <th>Verwijderen</th>
        </tr>";

foreach ($gebruikers as $gebruiker) {
    echo "<tr>
            <td>{$gebruiker['id']}</td>
            <td>{$gebruiker['naam']}</td>
            <td>{$gebruiker['achternaam']}</td>
            <td>{$gebruiker['leeftijd']}</td>
            <td><button>Edit</button></td>
            <td><button>Delete</button></td>
          </tr>";
}

echo "</table>";

$database->sluitVerbinding();
?>
