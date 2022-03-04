<?php

print_r($_GET['quan']);

if (isset($_COOKIE['cart'])) {
    $cart = json_decode($_COOKIE['cart'], true);
    $cartKeys = array_keys($cart);
    $cartId = implode(', ', $cartKeys);
    $cartQuantity = array_values($cart);
    $quantity = implode(', ', $cartQuantity);
    foreach ($cartKeys as $cartKey) {
        if(!is_int($cartKey)){
            die("Not all values are int");
        }
        else{
            $replacements = array($_GET['id'] => $_GET['quan']);
            $quantity = array_replace($cart, $replacements);
        }
    }
}else{
    $_SESSION['message'] = 'Cart is empty';
	header('location: cart.php');
}
?>