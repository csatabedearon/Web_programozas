<?php
if (isset($_COOKIE['random_number'])) {
    $random_number = $_COOKIE['random_number'];
} else {
    $random_number = rand(1, 100);
    setcookie('random_number', $random_number, time() + 3600);
    setcookie('attempts', 0, time() + 3600);
}

$message = '';

if (isset($_COOKIE['attempts'])) {
    $attempts = $_COOKIE['attempts'];
} else {
    $attempts = 0;
}

if (isset($_POST['submit'])) {
    $guess = intval($_POST['guess']);
    $attempts++;
    setcookie('attempts', $attempts, time() + 3600);

    if ($guess == $random_number) {
        $message = "Gratulálunk! Kitaláltad a számot $attempts próbálkozásból.";
        setcookie('random_number', '', time() - 3600);
        setcookie('attempts', '', time() - 3600);
        $attempts = 0;
    } elseif ($guess < $random_number) {
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
    if (isset($_COOKIE['attempts']) && $attempts > 0 && isset($guess) && $guess != $random_number) {
        echo "<p>Próbálkozások száma: $attempts</p>";
    }
    ?>
</body>
</html>
