<?php
//If-el

// Bemenő hónap
$honap = 4; // Például április

// Évszak meghatározása if-else segítségével
if ($honap == 12 || $honap == 1 || $honap == 2) {
    echo "Tél";
} elseif ($honap >= 3 && $honap <= 5) {
    echo "Tavasz";
} elseif ($honap >= 6 && $honap <= 8) {
    echo "Nyár";
} elseif ($honap >= 9 && $honap <= 11) {
    echo "Ősz";
} else {
    echo "Érvénytelen hónap!";
}


//Switch-el

// Évszak meghatározása switch segítségével
switch ($honap) {
    case 12:
    case 1:
    case 2:
        echo "Tél";
        break;
    case 3:
    case 4:
    case 5:
        echo "Tavasz";
        break;
    case 6:
    case 7:
    case 8:
        echo "Nyár";
        break;
    case 9:
    case 10:
    case 11:
        echo "Ősz";
        break;
    default:
        echo "Érvénytelen hónap!";
        break;
}
?>
