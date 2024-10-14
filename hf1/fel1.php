<?php
$array = [5, '5', '05', 12.3, '16.7', 'five', 'true', 0xDECAFBAD, '10e200'];

foreach ($array as $element) {
    $type = gettype($element);
    $isNumeric = is_numeric($element) ? "Igen" : "Nem";

    echo "Érték: $element, Típus: $type, Numerikus: $isNumeric\n";
}
