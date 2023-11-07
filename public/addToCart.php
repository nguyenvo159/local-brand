<?php
require_once __DIR__ . '/../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userId = $_POST['userID'];
    $productId = $_POST['productID'];
    $quantity = $_POST['quantity'];
    $cartRepository->addToCart($userId, $productId, $quantity);
    
}


