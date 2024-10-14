<?php
// Két szám és a műveleti jel előre megadva
$szam1 = 10; // Első szám
$szam2 = 5;  // Második szám
$muvelet = '+'; // Műveleti jel: +, -, *, /

// Számítás a switch utasítással
switch ($muvelet) {
    case '+':
        echo "$szam1 $muvelet $szam2 = " . ($szam1 + $szam2);
        break;
    case '-':
        echo "$szam1 $muvelet $szam2 = " . ($szam1 - $szam2);
        break;
    case '*':
        echo "$szam1 $muvelet $szam2 = " . ($szam1 * $szam2);
        break;
    case '/':
        if ($szam2 == 0) {
            echo "Hiba: 0-val való osztás nem lehetséges!";
        } else {
            echo "$szam1 $muvelet $szam2 = " . ($szam1 / $szam2);
        }
        break;
    default:
        echo "Hiba: Érvénytelen műveleti jel!";
        break;
}
?>
