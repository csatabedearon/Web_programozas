<?php
require 'db_connection.php';


if (!isset($conn)) {
    die("Hiba: Nincs adatbázis kapcsolat!");
}
if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
} else {
    echo "Sikeresen csatlakozva<br>";
}
$sql = "SELECT * FROM hallgatok";
$result = $con->query($sql);

echo "<a href='bevitel.php'> Új hallgató hozzáadása </a><br>";

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Név</th><th>Szak</th><th>Átlag</th><th colspan='2'>Muveletek</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nev"] . "</td>";
        echo "<td>" . $row["szak"] . "</td>";
        echo "<td>" . $row["atlag"] . "</td>";
        echo "<td><a href='update.php?id=" . $row["id"] . "'>Update</a></td>";
        echo "<td><a href='delete.php?id=" . $row["id"] . "'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nincs eredmény.";
}
?>
<link rel="stylesheet" href="tablazat_listazas.css">
