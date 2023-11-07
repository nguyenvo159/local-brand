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

$user = $userRepository->findById($_SESSION['user_id']);

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
                    <h1 class="mt-3 mb-5">Giỏ Hàng</h1>
                    <?php if (empty($carts)) : ?>
                        <div class="d-flex justify-content-center align-items-center">
                            <p>Giỏ rỗng. Vui lòng thêm sản phẩm vào giỏ!</p>
                        </div>
                    <?php else : ?>
                    <?php foreach ( $carts as $cart):  
                        $product = $product->find($cart->getProductId());
                        ?>
                        
                        <!-- Card Product in Cart -->
                        <div class="card mt-3 flex-row border-right-0 border-left-0 border-top-0" data-product-id="<?=htmlspecialchars($product->getId())?>">
                            <div class="card-img-left d-flex align-items-center" style="height: 154px;">
                                <img src="<?=htmlspecialchars($product->productIMG)?>"
                                    style="width:154px; height: 100%; object-fit: contain;" class="img-fluid"
                                    alt="Ảnh sản phẩm">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title main-hover" data-product-id="<?= htmlspecialchars($product->getId()) ?>"><?=htmlspecialchars($product->productName)?></h5>
                                <p class="price card-text">$<?=htmlspecialchars($product->price)?></p>

                                <div class="d-flex justify-content-between">
                                    <div class="input-group" style="width: 130px;">
                                        <input type="hidden" name="id" value="<?=htmlspecialchars($product->getId())?>">
                                        <div class="input-group-prepend">
                                            <button class="btn border rounded-0 decrease-btn" type="submit" data-product-id="<?=htmlspecialchars($product->getId())?>"
                                                data-product-price="<?=htmlspecialchars($product->price)?>">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" id="quantity<?=htmlspecialchars($cart->getProductId())?>" name="quantity" class="form-control input-number text-center"
                                            value="<?=htmlspecialchars($cart->getQuantity())?>" min="1" max="10">
                                        <div class="input-group-append">
                                            <button class="btn border rounded-0 increase-btn" type="submit" data-product-id="<?=htmlspecialchars($product->getId())?>"
                                                data-product-price="<?=htmlspecialchars($product->price)?>">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <p class="price m-0" data-product-id="<?=htmlspecialchars($product->getId())?>"> <b class="text-dark">Thành tiền: </b> $<?=htmlspecialchars($cart->getMoney())?></p>
                                    </div>
                                </div>
                                <div class="mt-2 mr-2 position-absolute"  style="right: 0; top: 0;">
                                    <button type="submit" class="btn delete-btn" data-product-id="<?=htmlspecialchars($product->getId())?>">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>                              
                            </div>
                            
                        </div>
                    <?php endforeach ?>
                    <div class="w-100 pt-3 pb-3 mt-3 d-flex justify-content-between  align-items-center">
                        <h5>Tổng thanh toán: <span id="totalMoney" class="price">$<?= number_format($cartRepository->getTotalMoney($_SESSION['user_id']), 2) ?></span></h5>
                        <a id="btn-orderCart" class="p-3 pr-5 pl-5 border btn btn-outline-0 rounded-0" type="button" data-toggle="modal" data-target="#orderModal">Đặt Hàng</a>
                    </div>

                    <!-- Modal Order -->
                    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderModalLabel">Xác nhận thanh toán</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                    <form id="orderForm" action="/order.php" method="post">
                                        <input type="hidden" name="userID" value="<?= $_SESSION['user_id']?>">
                                        <div class="row">
                                            <div class="form-group mb-1 d-flex justify-content-start align-items-center col-12">
                                                <label class="m-0  pr-1" for="user_name"><b>Họ và Tên: </b></label>
                                                <input type="text" class="form-control pt-1 border-0 w-75 rounded-0" id="user_name"
                                                    value="<?=$user->getFirstName() ?> <?=$user->getLastName() ?>" name="name" required>
                                            </div>
                                            <div class="form-group mb-1 d-flex justify-content-start align-items-center col-12">
                                                <label class="m-0  pr-1" for="user_phone"><b>Số Điện Thoại: </b></label>
                                                <input type="tel" class="form-control pt-1 border-0 w-75 rounded-0" id="user_phone" 
                                                    value="<?=$user->getPhone() ?>" name="phone" required>
                                            </div>
                                        
                                            <div class="form-group mb-1 d-flex justify-content-start align-items-center col-12">
                                                <label class="m-0  pr-1" for="user_email"> <b>Email: </b></label>
                                                <input type="email" class="form-control pt-1 border-0 w-75 rounded-0" id="user_email" 
                                                    value="<?=$user->getEmail() ?>" name="email" required>
                                            </div>
                                            <div class="form-group mb-1 d-flex justify-content-start align-iuser_tems-start col-12">
                                                <label class="m-0 pt-1 pr-1" for="user_address"> <b>Địa Chỉ: </b></label>
                                                <textarea class="form-control pt-0 border-0 w-75 rounded-0" id="user_address" name="address" 
                                                    placeholder="Vui lòng nhập địa chỉ" required rows="2"></textarea>                                            </div>
                                            </div>
                                            <hr>
                                            Đơn hàng gồm:
                                            <div class="row justify-content-start">
                                                <div class="col">
                                                    <?php foreach ( $carts as $cart): 
                                                        $product = $product->find($cart->getProductId());
                                                    ?>
                                                
                                                        <div class="card mt-3 flex-row border-0" data-product-id="<?=htmlspecialchars($product->getId())?>">
                                                            <div class="card-img-left d-flex align-items-center">
                                                                <img src="<?=htmlspecialchars($product->productIMG)?>"
                                                                    style="width:120px; height: 120px; object-fit: contain;" class="img-fluid"
                                                                    alt="Ảnh sản phẩm">
                                                            </div>
                                                            <div class="card-body">
                                                                <h5 class="card-title main-hover" data-product-id="<?= htmlspecialchars($product->getId()) ?>"><?=htmlspecialchars($product->productName)?></h5>
                                                                <p class="price card-text"> <i>$<?=htmlspecialchars($product->price)?></i> </p>

                                                                <div class="d-flex">
                                                                    <input type="hidden" name="quantity" value="<?=htmlspecialchars($cart->getQuantity())?>">
                                                                <p class="m-0 w-100 text-end" data-product-id="<?=htmlspecialchars($product->getId())?>">x<?=htmlspecialchars($cart->getQuantity())?></p>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    <?php endforeach ?>

                                                </div>
                                            </div>
                                            <hr>
                                            <div class ="p-2">
                                                <b class="mb-3">Tạm tính: <span  class="price">$<?= $cartRepository->getTotalMoney($_SESSION['user_id'])?></span></b><br>
                                                <b class="mb-3">Vận chuyển: <span  class="price">$2</span></b> <br>
                                                <b class="mb-3">Tổng thanh toán: <span id="totalMoney" class="price">$<?= $cartRepository->getTotalMoney($_SESSION['user_id']) + 2?></span></b>
                                                <input type="hidden" name="totalMoney" value="<?= $cartRepository->getTotalMoney($_SESSION['user_id']) + 2?>">
                                            </div>
                                            <div class="col-12">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-primary">Đặt Hàng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
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

                var productPrice = parseFloat($(`.decrease-btn[data-product-id="${productId}"]`).data('product-price'));
                var newTotalMoney = parseFloat($('#totalMoney').text().replace('$', '')) + (temp * productPrice);
            
                // Cập nhật giá trị totalMoney trên giao diện
                $('#totalMoney').text('$' + newTotalMoney.toFixed(2));

                var newProductMoney = (newQuantity * productPrice).toFixed(2);

                // Cập nhật giá trị "Thành tiền" của sản phẩm trên giao diện
                $(`.price[data-product-id="${productId}"]`).html(`<b class="text-dark">Thành tiền: </b> $${newProductMoney}`);


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


        // Xử lý xóa sản phẩm ra khỏi giỏ 
        $('.delete-btn').click(function() {
            var productId = $(this).data('product-id');
            var cardElement = $(`.card[data-product-id="${productId}"]`);           
            
            // Sử dụng Ajax để gửi yêu cầu xóa sản phẩm
            $.ajax({
                type: 'POST',
                url: '/deleteCart.php',
                data: {
                    userID: <?= $_SESSION['user_id'] ?>,
                    productID: productId,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        cardElement.remove();

                        // Cập nhật tổng tiền 
                        $('#totalMoney').text('$' + response.totalMoney.toFixed(2));
                    } 
                },

            });
        });
    });
</script>
</body>
</html>