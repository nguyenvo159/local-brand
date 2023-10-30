<?php
require_once __DIR__ . '/../../bootstrap.php';

use CT275\Labs\UserRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Xử lý đăng nhập
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $userRepository->findByEmail($email);

    if ($user && $userRepository->checkPassword($user, $password)) {
        // Đăng nhập thành công
        session_start();
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['firstname'] = $user->getFirstName();
        header('Location: /'); 
        exit();
    } else {
        $loginError = 'Thông tin email hoặc mật khẩu không chính xác.';
    }
}
include_once __DIR__ . '/../../partials/head.php';

?>

<body>
<?php include_once __DIR__ . '/../../partials/navbar.php' ?>
<div class="container">
    <!-- Login Form -->
    <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">ĐĂNG NHẬP</h2>
                <form  method="post">
                    <div class="form-group">
                        <label for="email-login">Email</label>
                        <input required type="email" class="input_form" id="email-login" name="email" placeholder="Nhập email"
                            value="<?php echo isset($email) ? $email : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password-login">Mật Khẩu</label>
                        <input required type="password" class="input_form" id="password-login" name="password" placeholder="Nhập mật khẩu"
                            value="<?php echo isset($password) ? $password : ''; ?>">
                    </div>
                    <span id="loginError" class="text-warning">
                        <?php echo isset($loginError) ? $loginError : ''; ?>
                    </span>
                    <button type="submit" class="mt-2 mb-2 w-100 btn btn-dark">Đăng nhập</button>
                    <br>
                    <br>
                    <a href="">Quên mật khẩu?</a>
                    <p class="mb-0">Bạn chưa có tài khoản? Đăng ký <a href="register.php">tại đây.</a></p>
                </form>
            </div>        
    </div>
</div>
        
<?php include_once __DIR__ . '/../../partials/footer.php' ?>

</body>

</html>


