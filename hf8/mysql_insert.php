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

$studentsData = array(
    array('John Doe', 'Informatika', 5.2),
    array('Alice Smith', 'Műszaki Informatika', 7.9),
    array('Bob Johnson', 'Gazdaságinformatika', 8.8),
    array('Eva Wilson', 'Matematika', 9.5),
    array('Mike Brown', 'Fizika', 5.0),
    array('Sarah Davis', 'Kémia', 3.7),
    array('David Lee', 'Biológia', 8.1),
    array('Linda Martinez', 'Informatika', 8.8),
    array('Tom Miller', 'Műszaki Informatika', 5.3),
    array('Karen Wilson', 'Gazdaságinformatika', 6.5)
);

$stmt = $conn->prepare("INSERT INTO hallgatok (nev, szak, atlag) VALUES (?, ?, ?)");

if (!$stmt) {
    die("Hiba a prepared statement létrehozásakor: " . $conn->error);
}

$stmt->bind_param("ssd", $nev, $szak, $atlag);

foreach ($studentsData as $student) {
    $nev = $student[0];
    $szak = $student[1];
    $atlag = $student[2];

    if ($stmt->execute()) {
        echo "Új rekord sikeresen létrehozva: $nev<br>";
    } else {
        echo "Hiba történt $nev hozzáadásakor: " . $stmt->error . "<br>";
    }
}

$stmt->close();
$conn->close();
?>
