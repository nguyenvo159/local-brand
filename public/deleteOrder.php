<?php
require_once __DIR__ . '/../bootstrap.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderID']))
 {
    $orderRepository->deleteOrder($_POST['orderID']);
    redirect('/order.php');
}
