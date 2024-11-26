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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM hallgatok WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: tablazat_listazas.php");
        exit();
    } else {
        echo "Hiba történt: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID paraméter hiányzik.";
}

$conn->close();
?>
