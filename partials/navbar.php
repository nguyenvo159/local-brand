<?php
use CT275\Labs\UserRepository;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="position-relative">
    <nav class="border-bottom navbar navbar-expand-md navbar-light bg-light position-relative">
        <a class="p-3 navbar-brand mr-auto d-flex align-items-center" href="/">
            <img src="https://vectorseek.com/wp-content/uploads/2023/07/Amiri-Logo-Vector.svg-.png" width=auto height="20"
                class="d-inline-block align-top" alt="Logo"></a>
        <div class="mx-auto font-vie collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto pr-5 pl-3">
                <li class="p-2 mr-3 ml-3 nav-item">
                    <a class="nav-content" href="/">Trang chủ<span class="sr-only">(current)</span></a>
                </li>
                <li class="p-2 mr-3 ml-3 nav-item">
                    <a class="nav-content " href=" #">Sale</a>
                </li>
                <li class="p-2 mr-3 ml-3 nav-item dropdown">
                    <a class="nav-content" dropdown-toggle href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        Sản Phẩm
                    </a>
                    <div class="border-0 pt-3 pb-0 m-0 rounded-0 dropdown-menu bg-light">
                        <div class="m-0 dropdown-divider"></div>
                        <a class="p-2 dropdown-item" href="/product.php">Tất cả</a>
                        <a class="p-2 dropdown-item" href="/product/shirts.php">Áo</a>
                        <a class="p-2 dropdown-item" href="/product/pants.php">Quần</a>
                        <a class="p-2 dropdown-item" href="/product/others.php">Khác</a>
                        <div class="m-0 dropdown-divider"></div>
                    </div>
                </li>
                <li class="p-2 mr-3 ml-3 nav-item">
                    <a class="nav-content" href="/about.php">About</a>
                </li>
            </ul>
        </div>
        <!-- Icon -->
        <div class="icon-nav d-flex justify-content-center align-items-center position-absolute mr-5"
            style="right: 0; top: 20px;">

            <div class=" d-flex">
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
                                    <a class="ml-3 text-dark dropdown-toggle" href="#" role="button" id="userDropdown" data-toggle="dropdown" 
                                    aria-haspopup="true" aria-expanded="false">' . $user->getLastName() . '</a>
                                    <div class="dropdown-menu mt-4 p-0 rounded-0 position-absolute" aria-labelledby="userDropdown" style="right: -10%; width:auto;">';
                            
                            // Kiểm tra nếu userID là 1 thì hiển thị tùy chọn "Quản lý"
                            if ($user->getId() == 1) {
                                echo '<a class="dropdown-item" href="/manager.php">Quản lý</a>
                                        <div class="dropdown-divider m-0"></div>';
                            }
                            
                            echo '<a class="dropdown-item" href="/auth/logout.php">Logout</a>
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
        class="slideInDown  m-0 p-2 position-absolute row justify-content-center align-items-center w-100  bg-light d-none"
        style="z-index: 999;">
        <h5 class="m-0">Tìm kiếm</h5>
        <form class="w-50 p-2 rounded form-inline">
            <div class="d-flex w-100 justify-content-center align-items-center icon-nav">
                <input class="input_form form-control-sm mr-3 w-100 roun" name="search" type="search"
                    placeholder="Vui lòng nhập sản phẩm bạn muốn tìm..." aria-label="Search">
                <i class="fa-solid fa-magnifying-glass fa-lg" type="submit"></i>
            </div>
        </form>
    </div>
</header>