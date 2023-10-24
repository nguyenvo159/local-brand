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
                        <a class="p-2 dropdown-item" href="product/product_shirts.php">Áo</a>
                        <a class="p-2 dropdown-item" href="product/product_pants.php">Quần</a>
                        <a class="p-2 dropdown-item" href="product/product_others.php">Phụ kiện</a>
                        <div class="m-0 dropdown-divider"></div>
                    </div>
                </li>
                <li class="p-2 mr-3 ml-3 nav-item">
                    <a class="nav-content" href="about.php">About</a>
                </li>
            </ul>
        </div>
        <!-- Icon -->
        <div class="icon-nav d-flex justify-content-center align-items-center position-absolute mr-5"
            style="right: 0; top: 20px;">

            <div class=" d-flex">
                <a id="search-btn" class="ml-3 text-dark" href="#"><i
                        class="fa-solid fa-magnifying-glass fa-lg"></i></a>
                <a class="ml-3 text-dark" href="#">
                    <i class="fa-solid fa-cart-shopping fa-lg"></i></a>
                <a class="ml-3 text-dark" href="#" type="button" data-toggle="modal" data-target="#loginModal">
                    <i class="fa-solid fa-user fa-lg"></i></a>
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
    <div class="font-vie modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div class="modal-header mt-3 mb-3 border-0 text-center position-relative d-flex justify-content-center align-items-center">
                    <img src="https://vectorseek.com/wp-content/uploads/2023/07/Amiri-Logo-Vector.svg-.png" width=auto height="50" class="d-inline-block align-top" alt="Logo">
                    <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close"
                        style="right:10px; top:10px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="modal-body pb-0">
                    <div class="border-bottom">
                        <ul class="mb-0 row justify-content-around list-unstyled ">
                            <li class="pb-2 decoration"><a id="login-btn"
                                    class="text-decoration-none font-weight-bold">ĐĂNG
                                    NHẬP</a></li>
                            <li class="pb-2"><a id="register-btn" class="text-decoration-none">ĐĂNG KÝ</a></li>
                        </ul>
                    </div>
                    <div class="container-fluid mt-3">
                        <div id="login-form">
                            <form>
                                <div class="form-group">
                                    <label for="email-login">Email</label>
                                    <input required type="email" class="input_form" id="email-login"
                                        placeholder="Nhập email">
                                </div>
                                <div class="form-group">
                                    <label for="password-login">Mật Khẩu</label>
                                    <input required type="password" class="input_form" id="password-login"
                                        placeholder="Nhập mật khẩu">
                                </div>
                                <!-- <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me">
                                <label class="form-check-label" for="remember_me">Ghi nhớ tôi</label>
                                </div> -->
                                <button type="submit" class="mt-2 mb-2 w-100 btn btn-dark">Đăng nhập</button>
                                <br>
                                <br>
                                <a href="">Quên mật khẩu?</a>
                                <p class="mb-0">Bạn chưa có tài khoản? Đăng ký <a id="register-switch" href="#">tại
                                        đây.</a>
                                </p>
                            </form>
                        </div>
                        <div id="register-form" class="hidden-content">
                            <form>
                                <div class="form-group">
                                    <label for="fullname">Họ và tên</label>
                                    <input required type="text" class="input_form" id="fullname"
                                        placeholder="Nhập họ và tên">
                                </div>
                                <div class="form-group">
                                    <label for="email-register">Email</label>
                                    <input required type="email" class="input_form" id="email-register"
                                        placeholder="Nhập email">
                                </div>
                                <div class="form-group">
                                    <label for="birthday">Ngày sinh</label>
                                    <input required type="date" class="input_form" id="birthday"
                                        placeholder="Ngày/Tháng/Năm">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input required type="tel" class="input_form" id="phone"
                                        placeholder="Số điện thoại">
                                </div>

                                <div class="form-group">
                                    <label for="password-register">Mật Khẩu</label>
                                    <input required type="password" class="input_form" id="password-register"
                                        placeholder="Nhập mật khẩu">
                                </div>
                                <div class="form-group">
                                    <label for="repassword-register">Nhập lại mật khẩu</label>
                                    <input required type="password" class="input_form" id="repassword-register"
                                        placeholder="Nhập lại mật khẩu">
                                </div>

                                <button type="submit" class="mt-2 mb-2 w-100 btn btn-dark">Đăng ký</button>
                                <br> <br>
                                <p>Bạn đã có tài khoản? Đăng nhập <a id="login-switch" href="#">tại đây</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header