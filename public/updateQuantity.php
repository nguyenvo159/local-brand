<?php
require_once __DIR__ . '/../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newQuantity = number_format($_POST['newQuantity']);
    $cart = $cartRepository->updateQuantity($_POST['userID'], $_POST['productID'], $newQuantity);

    
}


