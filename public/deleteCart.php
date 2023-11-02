<?php
require_once __DIR__ . '/../bootstrap.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['userID'])
    && isset($_POST['productID']))
 {
    $cart = $cartRepository->removeFromCart($_POST['userID'],$_POST['productID']);
}

redirect('/cart.php');