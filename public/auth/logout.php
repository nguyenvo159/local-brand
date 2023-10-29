<?php
session_start();

// Xóa tất cả dữ liệu của phiên
session_destroy();

// Chuyển hướng về trang chủ hoặc trang sau khi đăng xuất
header('Location: /');
exit();
?>
