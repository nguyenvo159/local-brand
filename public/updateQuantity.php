<?php
require_once __DIR__ . '/../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newQuantity = number_format($_POST['newQuantity']);
    $cart = $cartRepository->updateQuantity($_POST['userID'], $_POST['productID'], $newQuantity);

    // Trả về phản hồi tùy thuộc vào kết quả xử lý (điều này làm việc trong trường hợp giả định)
    if ($cart) {
        $updateCart = $cartRepository->getCartById($_POST['userID']);
        $money = $updateCart->getMoney();
        echo json_encode(['status' => 'success', 'message' => 'Update successful']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Update failed']);
    }
}


