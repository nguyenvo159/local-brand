<?php 
require_once __DIR__ . '/../bootstrap.php';
use CT275\Labs\Product;


if (isset($_GET['id']) && $_GET['id'] != 'undefined') {
    $productID = intval($_GET['id']);

    $products = new Product($PDO);
    $product = $products->find($productID);
    $otherProduct = $products->getByCategory($product->categoryID);


} else {
    redirect('/');
}

include_once __DIR__ . '/../partials/head.php';
?>

<body>
<?php include_once __DIR__ . '/../partials/navbar.php' ?>
    <!-- Toasts -->
    
<main>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class=" col-11 row">
                <div class="mt-3 mb-3 col-12">
                    <h2>Sản phẩm 
                        <?php
                            $categoryID = $product->categoryID;
                            $categories = [1 => "Áo", 2 => "Quần", 3 => "Phụ kiện"];
                            echo "/ $categories[$categoryID]" ?? "";
                        ?> 
                    </h2>
                </div>
                <div class="col-lg-7 col-12 mr-3">
                    <div id="carouselExampleControls" class="carousel slide border" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="<?=htmlspecialchars($product->productIMG)?>" class="d-block w-100" style="height: 500px; object-fit: contain;" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="<?=htmlspecialchars($product->productIMG)?>" class="d-block w-100" style="height: 500px; object-fit: contain;" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="<?=htmlspecialchars($product->productIMG)?>" class="d-block w-100" style="height: 500px; object-fit: contain;" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                            <span class="" aria-hidden="true" >
                                <i class="fa-solid fa-chevron-left" style="color: #000;"></i>
                            </span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                            <span class="" aria-hidden="true">
                                <i class="fa-solid fa-chevron-right" style="color: #000;"></i>
                            </span>
                            <span class="sr-only">Next</span>
                        </button>
                    </div>
                </div>
                

                <div class="p-4 col-lg-4 col-12">
                    <h3 class="card-title main-hover" data-product-id="<?= htmlspecialchars($product->getId()) ?>"><?=htmlspecialchars($product->productName)?></h3>
                    <hr>
                    <h4><span class="price">$<?=htmlspecialchars($product->price)?></span></h4> <br>
                    <div>
                        <h5>Mô tả:</h5>
                        <p><?=htmlspecialchars($product->description)?></p>
                    </div>
                    <br>
                    <h5>Số lượng:</h5>
                    <!-- <form id="form-quantity" action="/detail.php" method="post"> -->
                        <div class="input-group mb-3" style="width: 130px;">

                            <input type="hidden" name="productID" value="<?=htmlspecialchars($product->getId())?>">
                            <div class="input-group-prepend">
                                <button class="btn border rounded-0 decrease-quantity"  >
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                                <input type="text" id="quantityDetail"  name="quantity" class="form-control input-number text-center"
                                    value="1" min="1" max="100">
                            <div class="input-group-append">
                                <button class="btn border rounded-0 increase-quantity" >
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <button class="addFromDetai btn btn-dark pl-3 p-2 pr-3 rounded-0">Thêm vào giỏ</button>

                    <!-- </form> -->

                    <br> <br>
                    
                </div>
                <div class="col-lg-7 col-12 mt-4">
                    <p class="p-2"><b>Hướng dẫn bảo quản sản phẩm:</b> <br><br>

                    - Ngâm áo vào NƯỚC LẠNH có pha giấm hoặc phèn chua từ trong 2 tiếng đồng hồ<br><br>

                    - Giặt ở nhiệt độ bình thường, với đồ có màu tương tự.<br><br>

                    - Không dùng hóa chất tẩy.<br><br>

                    - Hạn chế sử dụng máy sấy và ủi (nếu có) thì ở nhiệt độ thích hợp.<br><br><br>

                    
                    <b>Chính sách bảo hành:</b><br><br>

                    - Miễn phí đổi hàng cho khách mua ở shop trong trường hợp bị lỗi từ nhà sản xuất, giao nhầm hàng, bị hư hỏng trong quá trình vận chuyển hàng.<br><br>

                    - Sản phẩm đổi trong thời gian 3 ngày kể từ ngày nhận hàng<br><br>

                    - Sản phẩm còn mới nguyên tem, tags và mang theo hoá đơn mua hàng, sản phẩm chưa giặt và không dơ bẩn, hư hỏng bởi những tác nhân bên ngoài cửa hàng sau khi mua hàng.</p>
                </div>
                <div class="col-12 " >
                    <hr>
                <h2 class="text-center mt-3 mb-3">
                    <a class="text-dark" href="
                        <?php
                            $category = $product->categoryID;

                            if ($category == 1) {
                                echo "/product/shirts.php";
                            } elseif ($category == 2) {
                                echo "/product/pants.php";
                            } elseif ($category == 3) {
                                echo "/product/others.php";
                            } 
                        ?>">
                        Các sản phẩm tương tự</a>

                </h2>
                    <div class="row justify-content-start">
                    <?php 
                    $limitedProducts = array_slice($otherProduct, 0, 4);
                    foreach ($limitedProducts as $product):  ?>
                        <div class=" justify-content-center mb-3 col-lg-3 col-md-4 col-6 pr-3">
                            <div class="card-container">
                                <div class="card border-0">
                                    <img class="card-img-top " style="height: 240px; width: auto; object-fit: contain;" src="<?=htmlspecialchars($product->productIMG)?>">
                                    <a type="button" class="icon-cardplus card-overlay">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </a>
                                    <div class="card-body text-center text-justify">
                                        <h5 class="card-title main-hover" data-product-id="<?= htmlspecialchars($product->getId()) ?>"><?=htmlspecialchars($product->productName)?></h5>
                                        <div class="row justify-content-around">
                                                <span class="price">$<?=htmlspecialchars($product->price)?></span>
                                                <span class="compare-price">350.000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../partials/footer.php' ?>



<script>
$(document).ready(function() {
    var quantityInput = $('#quantityDetail');
    var currentQuantity = parseInt(quantityInput.val());

    
    $('.increase-quantity').click(function(e) {
        e.preventDefault();
        updateQuantity(1);
    });

    $('.decrease-quantity').click(function(e) {
        e.preventDefault();
        updateQuantity(-1);
    });

    // Thêm vào giỏ
    $('.addFromDetai').click(function(){
        <?php if (isset($_SESSION['user_id'])) : ?>
            var productId = parseInt('<?php echo $productID; ?>', 10);
            var quantity = parseInt($('#quantityDetail').val(), 10);
            addToCart(productId, quantity);
        <?php else : ?>
            window.location.href = '/auth/login.php';
        <?php endif; ?>
    });

    function updateQuantity(quantity){
        var quantityInput = $('#quantityDetail');
        var currentQuantity = parseInt(quantityInput.val(), 10);
        var newQuantity = currentQuantity + quantity;
        if (newQuantity >= 1 && newQuantity <= 100) {
                quantityInput.val(newQuantity);
        }
    };

    function addToCart(productId, quantity) {
        var userID = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; ?>;
        $.ajax({
            type: 'POST',
            url: '/addToCart.php',
            data: {
                userID: <?= $_SESSION['user_id'] ?? 0; ?>,
                productID: productId,
                quantity:quantity,
            },
            dataType: 'json'
        });
        $('#quantityDetail').val(1);
    }
});
</script>

</body>
</html>