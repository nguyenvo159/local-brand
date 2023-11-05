<?php
require_once __DIR__ . '/../bootstrap.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userID']) && isset($_POST['productID']))
 {
    $cart = $cartRepository->removeFromCart($_POST['userID'],$_POST['productID']);

    $totalMoney = $cartRepository->getTotalMoney($_POST['userID']); 

    // Trả về phản hồi JSON
    echo json_encode(['success' => true, 'totalMoney' => $totalMoney]);
    exit();
}

// redirect('/cart.php');