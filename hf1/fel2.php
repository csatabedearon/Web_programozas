<?php
// Például megadunk egy másodperc értéket
$seconds = 7320.5;

// Ellenőrzés: csak akkor hajtjuk végre az átalakítást, ha az érték egész szám
if (is_int($seconds)) {
    // Átváltás órákra, percekre, másodpercekre
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $remainingSeconds = $seconds % 60;

    // Eredmény megjelenítése HTML címkékkel és változó behelyettesítéssel
    echo "<p>A megadott idő: <strong>{$hours} óra</strong>, <strong>{$minutes} perc</strong> és <strong>{$remainingSeconds} másodperc</strong>.</p>";
} else {
    // Hibaüzenet, ha nem egész számot kaptunk
    echo "<p><strong>Hiba:</strong> A megadott érték nem egész szám!</p>";
}
?>
