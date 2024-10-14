<?php
// Függvény egy sor létrehozására
function generateRow($isEvenRow) {
    $row = "<tr>";
    for ($i = 0; $i < 3; $i++) {
        // Váltakozó színek (fekete/fehér) beállítása az oszlop szerint
        $color = (($isEvenRow + $i) % 2 == 0) ? "white" : "black";
        $row .= "<td style='background-color: $color;'></td>";
    }
    $row .= "</tr>";
    return $row;
}

// Függvény a sakktábla létrehozására
function generateChessboard() {
    $board = <<<BOARD
<table border="1" cellspacing="0" cellpadding="10">
BOARD;

    // 3 sor létrehozása váltakozó színekkel
    for ($i = 0; $i < 3; $i++) {
        $board .= generateRow($i % 2 == 0); // Páros soroknál induljon fehérrel
    }

    $board .= <<<BOARD
</table>
BOARD;

    return $board;
}

// Sakktábla kiíratása
echo generateChessboard();
?>
