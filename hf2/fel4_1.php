<?php
function atalakit($tomb, $tipus)
{
    foreach ($tomb as $kulcs => $ertek) {
        if ($tipus === "kisbetus") {
            $tomb[$kulcs] = strtolower($ertek);
        } elseif ($tipus === "nagybetus") {
            $tomb[$kulcs] = strtoupper($ertek);
        }
    }
    return $tomb;
}

$szinek = array('A' => 'Kek', 'B' => 'Zold', 'c' => 'Piros');

$kisbetus = atalakit($szinek, "kisbetus");
print_r($kisbetus);

$nagybetus = atalakit($szinek, "nagybetus");
print_r($nagybetus);
