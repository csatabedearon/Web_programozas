<?php
function atalakit($tomb, $tipus)
{
    if ($tipus === "kisbetus") {
        return array_map('strtolower', $tomb);
    } elseif ($tipus === "nagybetus") {
        return array_map('strtoupper', $tomb);
    }
    return $tomb;
}

$szinek = array('A' => 'Kek', 'B' => 'Zold', 'c' => 'Piros');

$kisbetus = atalakit($szinek, "kisbetus");
print_r($kisbetus);

$nagybetus = atalakit($szinek, "nagybetus");
print_r($nagybetus);
