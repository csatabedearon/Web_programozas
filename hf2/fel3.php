<?php
$napok = array(
    "HU" => array("H", "K", "Sze", "Cs", "P", "Szo", "V"),
    "EN" => array("M", "Tu", "W", "Th", "F", "Sa", "Su"),
    "DE" => array("Mo", "Di", "Mi", "Do", "F", "Sa", "So"),
);

function kiemeltNappalKiir($nyelv, $napok)
{
    foreach ($napok as $kulcs => $ertek) {
        if ($ertek == "K" || $ertek == "Cs" || $ertek == "Szo" || $ertek == "Tu" || $ertek == "Th" || $ertek == "Sa" || $ertek == "Di" || $ertek == "Do" || $ertek == "Sa") {
            $napok[$kulcs] = "<b>" . $ertek . "</b>";
        }
    }
    echo "$nyelv: " . implode(", ", $napok) . "<br>";
}

foreach ($napok as $nyelv => $napLista) {
    kiemeltNappalKiir($nyelv, $napLista);
}
