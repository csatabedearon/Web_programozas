<?php
$color = "aqua";

$szorzotabla = function ($n) use ($color) {
    echo "<table border='1' border-collapse='5' border-spacing='0'>";
    for ($i = 1; $i <= $n; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= $n; $j++) {
            if ($i == $j) {
                echo "<td style='background-color:$color;'>" . ($i * $j) . "</td>";
            } else {
                echo "<td>" . ($i * $j) . "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
};

$szorzotabla(10);
