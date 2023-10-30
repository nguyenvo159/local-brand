<?php 
require_once __DIR__ . '/../bootstrap.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php'); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    exit();
}




include_once __DIR__ . '/../partials/head.php';
?>

<body>
<?php include_once __DIR__ . '/../partials/navbar.php' ?>

<main>
<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                    <h1 class="mt-3 mb-3">Giỏ Hàng</h1>

                    <!-- Card Product in Cart -->
                    <div class="card mt-3 flex-row rounded-0">
                        <div class="card-img-left d-flex align-items-center" style="height: 154px;">
                            <img src="https://product.hstatic.net/200000031420/product/setupthong14444_987441d416124d5b861a43010b2510d0_master.jpg"
                                style="width:auto; height: 100%; object-fit: contain;" class="img-fluid"
                                alt="Ảnh sản phẩm">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Tên Sản Phẩm</h5>
                            <p class="card-text">$50.00</p>

                            <div class="d-flex justify-content-between">
                                <div class="input-group" style="width: 130px;">
                                    <input type="hidden" name="id" value="">
                                    <div class="input-group-prepend">
                                        <button class="btn border rounded-0" type="button">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="quanlity" class="form-control input-number text-center"
                                        value="1" min="1" max="10">
                                    <div class="input-group-append">
                                        <button class="btn border rounded-0" type="button">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <p class="m-0">Thành tiền: $50.00</p>
                                </div>
                            </div>
                            <button class="btn mt-2 mr-2 position-absolute" style="right: 0; top: 0;">
                                <i class="fas fa-times"></i>
                            </button>

                        </div>
                    </div>
                    
                    
                    


                    <div class="w-100 border-top pt-3 pb-3 mt-5 d-flex justify-content-between  align-items-center">
                        <h5>Tổng thanh toán: $59.99</h5>
                        <a id="btn-orderCart" class="p-3 pr-5 pl-5 border btn btn-outline-0 rounded-0">Đặt Hàng</a>
                    </div>

                </div>
            </div>
        </div>

    </main>
</main>

<?php include_once __DIR__ . '/../partials/footer.php' ?>

</body>