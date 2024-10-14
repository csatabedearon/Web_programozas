<?php

$orszagok = array(
    " Magyarország " => " Budapest",
    " Románia" => " Bukarest",
    "Belgium" => "Brussels",
    "Austria" => "Vienna",
    "Poland" => "Warsaw"
);

foreach ($orszagok as $key => $value) {
    echo $key . " fővárosa " . "<span style='color:red;'>$value</span>" . "<br>";
}
