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

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nev = $_POST['nev'];
    $szak = $_POST['szak'];
    $atlag = $_POST['atlag'];

    $stmt = $conn->prepare("UPDATE hallgatok SET nev=?, szak=?, atlag=? WHERE id=?");
    $stmt->bind_param("ssdi", $nev, $szak, $atlag, $id);

    if ($stmt->execute()) {
        echo "Sikeresen frissítve.";
        header("Location: tablazat_listazas.php");
        exit();
    } else {
        echo "Hiba a frissítés során: " . $stmt->error;
    }

    $stmt->close();
} else {
    $stmt = $conn->prepare("SELECT * FROM hallgatok WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
}
?>
<link rel="stylesheet" href="update.css">

<div class="form-container">
    <h2>Update Student Info</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <label for="nev">Nev:</label>
        <input type="text" name="nev" value="<?php echo htmlspecialchars($row['nev'], ENT_QUOTES, 'UTF-8'); ?>"><br>
        
        <label for="szak">Szak:</label>
        <input type="text" name="szak" value="<?php echo htmlspecialchars($row['szak'], ENT_QUOTES, 'UTF-8'); ?>"><br>
        
        <label for="atlag">Atlag:</label>
        <input type="text" name="atlag" value="<?php echo htmlspecialchars($row['atlag'], ENT_QUOTES, 'UTF-8'); ?>"><br>
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>">
        <input type="submit" name="submit" value="Elkuld">
    </form>
</div>
