<?php
// Két bemenő változó megadása
$a = 5;
$b = 3;

// Alapműveletek végrehajtása
$addition = $a + $b;
$subtraction = $a - $b;
$multiplication = $a * $b;
$division = $a / $b;
$exponentiation = pow($a, $b);

// Eredmények kiírása változó behelyettesítéssel és szövegösszefűzéssel
echo "<p>{$a} + {$b} = {$addition}</p>";
echo "<p>{$a} - {$b} = {$subtraction}</p>";
echo "<p>{$a} * {$b} = {$multiplication}</p>";
echo "<p>{$a} / {$b} = {$division}</p>";
echo "<p>{$a} a {$b}. hatványon = {$exponentiation}</p>";
?>
