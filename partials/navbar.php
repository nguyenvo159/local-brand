<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="position-relative">
    <nav class="border-bottom navbar navbar-expand-lg navbar-light bg-light position-relative">
        <a class="p-3 navbar-brand mr-auto d-flex align-items-center" href="/">
            <img src="https://vectorseek.com/wp-content/uploads/2023/07/Amiri-Logo-Vector.svg-.png" width=auto height="20"
                class="d-inline-block align-top" alt="Logo"></a>
        <div class="mx-auto pr-5 font-vie collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto pr-5 pl-3">
                <li class="p-2 mr-3 ml-3 nav-item">
                    <a class="nav-content" href="/">Trang Chủ<span class="sr-only">(current)</span></a>
                </li>
                <!-- <li class="p-2 mr-3 ml-3 nav-item">
                    <a class="nav-content " href=" #">Sale</a>
                </li> -->
                <li class="p-2 mr-3 ml-3 nav-item dropdown">
                    <a class="nav-content" dropdown-toggle  role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        Sản Phẩm
                    </a>
                    <div class="border-0 pt-3 m-0 rounded-0 dropdown-menu bg-light">
                        <!-- <div class="m-0 dropdown-divider"></div> -->
                        <a class="p-2 dropdown-item" href="/product.php">Tất cả</a>
                        <a class="p-2 dropdown-item" href="/product/shirts.php">Áo</a>
                        <a class="p-2 dropdown-item" href="/product/pants.php">Quần</a>
                        <a class="p-2 dropdown-item" href="/product/others.php">Phụ Kiện</a>
                    </div>
                </li>
                <li class="p-2 mr-3 ml-3 nav-item">
                    <a class="nav-content" href="/about.php">Về Chúng Tôi</a>
                </li>
            </ul>
        </div>
        <!-- Icon -->
        <div class="icon-nav d-flex justify-content-center align-items-center position-absolute mr-5"
            style="right: 0; top: 20px;">

            <div class=" d-flex align-items-center">
                <a id="search-btn" class="ml-3 text-dark" href="#"><i
                        class="fa-solid fa-magnifying-glass fa-lg"></i></a>
                <a class="ml-3 text-dark" href="/cart.php">
                    <i class="fa-solid fa-cart-shopping fa-lg"></i></a>
                <!-- <a class="ml-3 text-dark" href="#" type="button" data-toggle="modal" data-target="#loginModal">
                    <i class="fa-solid fa-user fa-lg"></i></a> -->
                    <?php
                        // Kiểm tra xem người dùng đã đăng nhập hay chưa
                        if (isset($_SESSION['user_id'])) {
                            $userId = $_SESSION['user_id'];
                            $user = $userRepository->findById($userId);

                            // Hiển thị tên người dùng
                            echo '<div class="">
                                    <a class="main-hover text-decoration-none ml-3 text-dark dropdown-toggle" href="#" role="button" id="userDropdown" data-toggle="dropdown" 
                                    aria-haspopup="true" aria-expanded="false">' . $user->getLastName() . '</a>
                                    <div class="dropdown-menu mt-4 p-0 rounded-0 position-absolute" aria-labelledby="userDropdown" style="right: -10%; width:auto;">';
                            
                            echo '<a class="p-1 pl-4 text-start dropdown-item" href="/profile.php">
                                <i class=" mr-2 fa-solid fa-user"></i>Tài khoản</a>
                                <div class="dropdown-divider m-0"></div>';
                            // Kiểm tra nếu userID là 1 thì hiển thị tùy chọn "Quản lý"
                            if ($user->getId() == 1) {
                                echo '<a class="p-1 pl-4 text-start dropdown-item" href="/manager.php">
                                        <i class="mr-2 fa-solid fa-list-check"></i>Quản lý SP</a>
                                        <div class="dropdown-divider m-0"></div>';
                                echo '<a class="p-1 pl-4 text-start dropdown-item" href="/managerOrder.php">
                                        <i class="mr-2 fa-solid fa-bars-progress"></i>Quản lý ĐH</a>
                                        <div class="dropdown-divider m-0"></div>';
                            }
                            
                            echo '<a class="p-1 pl-4 text-start dropdown-item" href="/order.php">
                                        <i class=" mr-2 fa-solid fa-clipboard-list"></i>Đơn hàng</a>
                                        <div class="dropdown-divider m-0"></div>';
                            echo '<a class="p-1 pl-4 text-start dropdown-item" href="/auth/logout.php">
                                        <i class="mr-2 fa-solid fa-right-from-bracket"></i>Logout</a>
                                    </div>
                                    </div>';
                        } else {
                            // Chưa đăng nhập, hiển thị icon "fa-user"
                            echo '<a class="ml-3 text-dark" href="/auth/login.php" type="button" >
                                    <i class="fa-solid fa-user fa-lg"></i>
                                </a>';
                        }
                    ?>
            </div>
            <!-- bars -->
            <button class="navbar-toggler ml-3" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i id="bars" class="fa-solid fa-caret-down" style="color: #000000;"></i>
            </button>
        </div>
    </nav>
        <!-- Search -->
    <div id="search-input"
        class="slideInDown shadow  m-0 p-2 position-absolute row justify-content-center align-items-center w-100  bg-light d-none"
        style="z-index: 999;">
        <h5 class="m-0">Tìm kiếm</h5>
        <form id="search-form" action="/search.php" method="get" class="w-50 p-2 rounded form-inline">
            <div class="d-flex w-100 justify-content-center align-items-center icon-nav">
                <input class="input_form form-control-sm mr-3 w-100 roun" name="key" type="search"
                    placeholder="Vui lòng nhập sản phẩm bạn muốn tìm..." aria-label="Search">
                <button type="submit" class="btn btn-link">
                    <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                </button>
            </div>
        </form>
    </div>
</header>

<!-- Toasts -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 99; right: 0; bottom:0;">
    <div id="addToCartToast" class="toast rounded-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="500">
        <div class="toast-header">
            <strong class="mr-auto text-warning">Thông báo</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Đã thêm sản phẩm vào <b>Giỏ hàng</b>
        </div>
    </div>
</div>