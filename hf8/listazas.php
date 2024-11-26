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


$sql="SELECT * FROM hallgatok";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Név: " . $row["nev"] . " - Szak: " . $row["szak"] . " - Atlag: " . $row["atlag"] . "<br>";
    }
} else {
    echo "Nincs eredmény.";
}
$conn->close();
?>