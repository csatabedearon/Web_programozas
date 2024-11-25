<?php

function getCartsByUserId($userId) {
    $url = "https://fakestoreapi.com/carts/user/" . $userId;
    $response = makeCurlRequest($url);
    return json_decode($response, true);
}

function getAllProducts() {
    $url = "https://fakestoreapi.com/products";
    $response = makeCurlRequest($url);
    return json_decode($response, true);
}

function calculateCartTotal($carts, $products) {
    $total = 0;

    $productPrices = [];
    foreach ($products as $product) {
        $productPrices[$product['id']] = $product['price'];
    }

    foreach ($carts as $cart) {
        foreach ($cart['products'] as $cartItem) {
            $productId = $cartItem['productId'];
            $quantity = $cartItem['quantity'];
            if (isset($productPrices[$productId])) {
                $total += $productPrices[$productId] * $quantity;
            }
        }
    }

    return $total;
}

function makeCurlRequest($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

$userId = 1;
$carts = getCartsByUserId($userId);
$products = getAllProducts();
$total = calculateCartTotal($carts, $products);

echo "Az $userId-es user kosarainak összértéke: $" . $total;

?>
