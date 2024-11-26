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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nev = $_POST["nev"];
    $szak = $_POST["szak"];
    $atlag = $_POST["atlag"];

    $stmt = $conn->prepare("INSERT INTO hallgatok (nev, szak, atlag) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $nev, $szak, $atlag);

    if ($stmt->execute()) {
        header("Location: success.php");
        exit();
    } else {
        echo "Hiba: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <title>Új hallgató bevitele</title>
</head>
<link rel="stylesheet" href="bevitel.css">

<body>
    <div class="form-container">
        <h2>Új hallgató hozzáadása</h2>
        <form method="post" action="bevitel.php">
            <label for="nev">Név:</label><br>
            <input type="text" id="nev" name="nev" required><br><br>

            <label for="szak">Szak:</label><br>
            <input type="text" id="szak" name="szak" required><br><br>

            <label for="atlag">Átlag:</label><br>
            <input type="number" id="atlag" name="atlag" step="0.1" min="0" required><br><br>

            <input type="submit" value="Hozzáadás">
        </form>
    </div>
</body>

</html>
