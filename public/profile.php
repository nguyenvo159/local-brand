<?php
require_once __DIR__ . '/../bootstrap.php';
use CT275\Labs\OrderDetail;
use CT275\Labs\Product;


session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php'); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    exit();
}

$user = $userRepository->findById($_SESSION['user_id']);
$result =false;
$resultPasswordUpdate =false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['firstName']) && isset($_POST['lastName']) &&isset($_POST['email']) && isset($_POST['phone'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        

        // Assume $userRepository is an instance of UserRepository
        $result = $userRepository->updateUserProfile($user->getId(), $firstName, $lastName, $email, $phone);
    }

    if (isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $oldPassword = $_POST['old_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];
        if ($oldPassword == $newPassword){
            $error_password = 'Mật khẩu mới không thể giống mất khẩu cũ';
        }
        elseif ($userRepository->checkPassword($user, $oldPassword)) {
            if ($newPassword === $confirmPassword) {
                $resultPasswordUpdate = $userRepository->updatePassword($user->getId(), $newPassword);
            }
        }
        
         else{
            $error_password = 'Mật khẩu cũ bạn nhập sai';
        }
    }
}

include_once __DIR__ . '/../partials/head.php';
?>

<body>
<?php include_once __DIR__ . '/../partials/navbar.php' ?>



<main class="position-relative">
    <div class ="container mt-3">
        <h1 class="mb-4" >Quản lý thông tin tài khoản</h1>

        <div class="row">
            <div class="mt-3 col-lg-6">
                <h4>Thông tin cá nhân</h4>
                <form class="" action="" method="post">
                    <table class="table w-75">
                        <tr class="d-flex align-items-center">
                            <td class="border-0 d-flex align-items-center">
                                <label class="m-0" for="user_name"><b>Họ:</b></label>
                            </td>
                            <td class="border-0">
                                <input type="text" class="form-control border-0 rounded-0" id="user_name" value="<?= $user->getFirstName() ?>" name="firstName" required>
                            </td>
                        </tr>
                        <tr class="d-flex align-items-center">
                            <td class="border-0 d-flex align-items-center">
                                <label class="m-0" for="lastName"><b>Tên:</b></label>
                            </td>
                            <td class="border-0">
                                <input type="text" class="form-control border-0 rounded-0" id="lastName" value="<?= $user->getLastName() ?>" name="lastName" required>
                            </td>
                        </tr>
                        <tr class="d-flex align-items-center">
                            <td class="border-0 d-flex align-items-center">
                                <label class="m-0" for="user_phone"><b>Phone:</b></label>
                            </td>
                            <td class="border-0">
                                <input type="tel" class="form-control border-0 rounded-0" id="user_phone" value="<?= $user->getPhone() ?>" name="phone" required>
                            </td>
                        </tr>
                        <tr class="d-flex align-items-center">
                            <td class="border-0 d-flex align-items-center">
                                <label class="m-0" for="user_email"><b>Email:</b></label>
                            </td>
                            <td class="border-0">
                                <input type="email" class="form-control border-0 rounded-0" id="user_email" value="<?= $user->getEmail() ?>" name="email" required>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="ml-3 btn btn-primary">Cập nhật</button>
                </form>
            </div>
            <div id="form-changePassword" class="mt-3 col-lg-6">
                <h4 class="mb-3">Đổi mật khẩu</h4>
                <form action="" method="post">
                    <table class="table w-75 m-0">
                        <tr>
                            <td class="border-0">
                                <label for="old_password"><b>Mật khẩu cũ:</b></label>
                            </td>
                            <td class="border-0">
                                <input type="password" class="form-control" id="old_password" value="" name="old_password" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-0">
                                <label for="password-register"><b>Mật khẩu mới:</b></label>
                            </td>
                            <td class="border-0">
                                <input type="password" class="form-control" id="password-register" value="" name="new_password" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-0">
                                <label for="repassword-register"><b>Nhập lại mật khẩu:</b></label>
                            </td>
                            <td class="border-0">
                                <input type="password" class="form-control" id="repassword-register" value="" name="confirm_password" required>
                            </td>
                        </tr>
                    </table>
                    <div class="ml-3 mb-2">
                    <span class="text-warning w-100" id="error-password">
                            <b><?php echo isset($error_password) ? $error_password : ''; ?></b> <br>
                            <span class="text-warning w-100" id="repassword-registerError"></span>

                        </span>
                        
                    </div>
                    <button type="submit" class="ml-3 btn btn-secondary">Đổi mật khẩu</button>

                </form>

            </div>

        </div>
    </div>
    
</main>    



<?php include_once __DIR__ . '/../partials/footer.php' ?>

<script>
    <?php if ((isset($result) && $result === true) || (isset($resultPasswordUpdate) && $resultPasswordUpdate == true)) : ?>
        
        alert("Cập nhật thành công");
        window.location.href = "/profile.php";
    <?php endif; ?>
</script>

</body>
</html>