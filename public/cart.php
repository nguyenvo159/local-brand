<?php 
require_once __DIR__ . '/../bootstrap.php';
use CT275\Labs\Product;

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php'); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    exit();
}
$product = new Product($PDO);
$products = $product->all();
$totalMoney = 0;


$carts =  $cartRepository->getAllCartsByUserId($_SESSION['user_id']);

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
                    <?php foreach ( $carts as $cart):  
                        $product = $product->find($cart->getProductId());
                        $totalMoney += $cart->getMoney();
                        ?>
                        
                        <!-- Card Product in Cart -->
                        <div class="card mt-3 flex-row border-0">
                            <div class="card-img-left d-flex align-items-center" style="height: 154px;">
                                <img src="<?=htmlspecialchars($product->productIMG)?>"
                                    style="width:auto; height: 100%; object-fit: contain;" class="img-fluid"
                                    alt="Ảnh sản phẩm">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?=htmlspecialchars($product->productName)?></h5>
                                <p class="price card-text">$<?=htmlspecialchars($product->price)?></p>

                                <div class="d-flex justify-content-between">
                                    <div class="input-group" style="width: 130px;">
                                        <input type="hidden" name="id" value="<?=htmlspecialchars($product->getId())?>">
                                        <div class="input-group-prepend">
                                            <button class="btn border rounded-0 decrease-btn" type="submit" data-product-id="<?=htmlspecialchars($product->getId())?>">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" id="quantity<?=htmlspecialchars($cart->getProductId())?>" name="quantity" class="form-control input-number text-center"
                                            value="<?=htmlspecialchars($cart->getQuantity())?>" min="1" max="10">
                                        <div class="input-group-append">
                                            <button class="btn border rounded-0 increase-btn" type="submit" data-product-id="<?=htmlspecialchars($product->getId())?>">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <p class="price m-0"><b class="text-dark">Thành tiền: </b> $<?=htmlspecialchars($cart->getMoney())?></p>
                                    </div>
                                </div>
                                <form class="mt-2 mr-2 position-absolute" action="/deleteCart.php" method="POST"  style="right: 0; top: 0;">
                                    <input type="hidden" name="userID" value="<?= $_SESSION['user_id']?>">
                                    <input type="hidden" name="productID" value="<?=htmlspecialchars($product->getId())?>">
                                    <button type="submit" class="btn ">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                

                            </div>
                        </div>
                    <?php endforeach ?>

                    <div class="w-100 border-top pt-3 pb-3 mt-5 d-flex justify-content-between  align-items-center">
                        <h5>Tổng thanh toán: $<?= $totalMoney;?></h5>
                        <a id="btn-orderCart" class="p-3 pr-5 pl-5 border btn btn-outline-0 rounded-0">Đặt Hàng</a>
                    </div>
                </div>
            </div>
        </div>

    </main>
</main>

<?php include_once __DIR__ . '/../partials/footer.php' ?>
<script>
    $(document).ready(function() {
        function updateQuantity(productId, temp) {
            var quantityInput = $('#quantity' + productId);
            var currentQuantity = parseInt(quantityInput.val(), 10);
            var newQuantity = currentQuantity + temp;

            if (newQuantity >= 1 && newQuantity <= 100) {
                quantityInput.val(newQuantity);
                $.ajax({
                    type: 'POST',
                    url: '/updateQuantity.php',
                    data: {
                        userID: <?= $_SESSION['user_id'] ?>,
                        productID: productId,
                        newQuantity: newQuantity,
                    },
                    dataType: 'json', 
                    
                });
            }
        }
        
        $('.decrease-btn').click(function() {
            var productId = $(this).data('product-id');
            updateQuantity(productId, -1);
        });

        $('.increase-btn').click(function() {
            var productId = $(this).data('product-id');
            updateQuantity(productId, 1);
        });
    });
</script>
</body>
</html>