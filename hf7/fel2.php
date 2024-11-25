<?php
session_start();

if (!isset($_SESSION['random_number'])) {
    $_SESSION['random_number'] = rand(1, 100);
    $_SESSION['attempts'] = 0;
}

$message = '';

if (isset($_POST['submit'])) {
    $guess = intval($_POST['guess']);
    $_SESSION['attempts']++;

    if ($guess == $_SESSION['random_number']) {
        $message = "Gratulálunk! Kitaláltad a számot " . $_SESSION['attempts'] . " próbálkozásból.";
        session_unset();
        session_destroy();
    } elseif ($guess < $_SESSION['random_number']) {
        $message = "A tipped túl alacsony.";
    } else {
        $message = "A tipped túl magas.";
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Számkitaláló Játék</title>
</head>
<body>
    <h1>Számkitaláló Játék</h1>
    <p>Gondoltam egy számra 1 és 100 között. Találd ki!</p>

    <form method="POST" action="">
        <label for="guess">Tipp:</label>
        <input type="number" name="guess" id="guess" min="1" max="100" required>
        <input type="submit" name="submit" value="Tippel">
    </form>

    <?php
    if ($message != '') {
        echo "<p>$message</p>";
    }
    if (isset($_SESSION['attempts']) && isset($guess) && $guess != $_SESSION['random_number']) {
        echo "<p>Próbálkozások száma: " . $_SESSION['attempts'] . "</p>";
    }
    ?>
</body>
</html>
