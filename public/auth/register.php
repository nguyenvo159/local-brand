<?php
require_once __DIR__ . '/../../bootstrap.php';
use CT275\Labs\UserRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $phone = $_POST['phone'];

    // Kiểm tra xem người dùng đã tồn tại hay chưa
    if ($userRepository->findByEmail($email)) {
        $emailExistError = 'Email đã được sử dụng';
    } else {
        // Thêm người dùng mới
        if ($userRepository->addUser($firstName, $lastName, $email, $password, $phone)) {
            // Đăng ký thành công, thực hiện đăng nhập
            $user = $userRepository->findByEmail($email);
            session_start();
        $_SESSION['user_id'] = $user->getId();
        header('Location: /'); 
        exit();
        } else {
            echo 'Đăng ký thất bại.';
        }
        
    }
}
include_once __DIR__ . '/../../partials/head.php' 

?>


<body>
<?php include_once __DIR__ . '/../../partials/navbar.php' ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
        <h2 class="text-center">ĐĂNG KÝ</h2>
            <form  method="post">
                <div class="row">
                    <!-- Họ -->
                    <div class="col-md-6 form-group ">
                        <label for="firstName">Họ</label>
                        <input required type="text" class="input_form" id="firstName" name="firstName" minlength="2" maxlength="30" placeholder="Nhập họ và tên đệm"
                            value="<?php echo isset($firstName) ? $firstName : ''; ?>">
                        <!-- <span id="firstNameError" class="text-warning">
                            <strong>Họ không hợp lệ</strong>
                        </span> -->
                    </div>

                    <!-- Tên -->
                    <div class="col-md-6 form-group">
                        <label for="lastName">Tên</label>
                        <input required type="text" class="input_form" id="lastName" name="lastName" minlength="2" maxlength="10" placeholder="Nhập tên"
                            value="<?php echo isset($lastName) ? $lastName : ''; ?>">
                        <!-- <span id="lastNameError" class="text-warning" >
                            <strong>Tên không hợp lệ</strong>
                        </span> -->
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email-register">Email</label>
                    <input required type="email" class="input_form" id="email-register" name="email" placeholder="Nhập email"
                        value="<?php echo isset($email) ? $email : ''; ?>">
                    <span id="email-registerError" class="text-warning">
                        <?php if(isset($emailExistError)) echo $emailExistError; ?>
                    </span>
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input required type="tel" class="input_form" id="phone" name="phone" placeholder="Số điện thoại"
                        value="<?php echo isset($phone) ? $phone : ''; ?>">
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password-register">Mật Khẩu</label>
                    <input required type="password" class="input_form" id="password-register" name="password" minlength="6" maxlength="20" placeholder="Nhập mật khẩu"
                        value="<?php echo isset($password) ? $password : ''; ?>">
                    <!-- <span id="password-registerError" class="text-warning">
                        <strong>Mật khẩu không hợp lệ</strong>
                    </span> -->
                </div>
                <div class="form-group">
                    <label for="repassword-register">Nhập lại mật khẩu</label>
                    <input required type="password" class="input_form" id="repassword-register" name="repassword" minlength="6" maxlength="20" placeholder="Nhập lại mật khẩu"
                        value="<?php echo isset($repassword) ? $repassword : ''; ?>">
                    <span id="repassword-registerError" class="text-warning">
                    </span>
                </div>

                <button type="submit" class="mt-2 mb-2 w-100 btn btn-dark">Đăng ký</button>
                <br> <br>
                <p>Bạn đã có tài khoản? Đăng nhập <a id="login-switch" href="login.php">tại đây</a></p>
            </form>
        </div>
    </div>
</div>
<?php include_once __DIR__ . '/../../partials/footer.php' ?>

</body>
</html>