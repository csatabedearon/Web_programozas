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

$sql = "CREATE DATABASE IF NOT EXISTS egyetem";
if ($conn->query($sql) === TRUE) {
    echo "Adatbázis sikeresen létrehozva<br>";
} else {
    echo "Hiba az adatbázis létrehozásakor: " . $conn->error . "<br>";
}

$conn->select_db("egyetem");

$sql = "CREATE TABLE IF NOT EXISTS hallgatok (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(255) NOT NULL,
    szak VARCHAR(255) NOT NULL,
    atlag DOUBLE NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tábla sikeresen létrehozva<br>";
} else {
    echo "Hiba a tábla létrehozásakor: " . $conn->error . "<br>";
}

$conn->close();

?>
