<?php 
require_once __DIR__ . '/../bootstrap.php';
use CT275\Labs\Product;

$product = new Product($PDO);

$products = $product->all();



include_once __DIR__ . '/../partials/head.php';
?>

<body>
<?php include_once __DIR__ . '/../partials/navbar.php' ?>
    <!-- Toasts -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 99; right: 0; bottom:0;">
        <div id="addToCartToast" class="toast rounded-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
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
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-10 offset-1">
                <div class="mt-3 mb-3 d-flex justify-content-center">
                    <a class="active-bottom p-3 pr-4 pl-4 font-weight-bold main-hover text-decoration-none" style="font-size: 18px;" href="/product.php">Tất cả sản phẩm</a>
                    <a class="p-3 pr-4 pl-4 font-weight-bold main-hover text-decoration-none" style="font-size: 18px;" href="/product/shirts.php">Áo</a>
                    <a class="p-3 pr-4 pl-4 font-weight-bold main-hover text-decoration-none" style="font-size: 18px;" href="/product/pants.php">Quần</a>
                    <a class="p-3 pr-4 pl-4 font-weight-bold main-hover text-decoration-none" style="font-size: 18px;" href="/product/others.php">Phụ kiện</a>                   
                </div>
                <div class="row justify-content-start">
                    <!-- Card -->
                    <?php foreach ($products as $product):  ?>
                        <div class=" justify-content-center mb-3 col-lg-3 col-md-4 col-6 pr-3">
                            <div class="card-container">
                                <div class="card border-0">
                                    <img class="card-img-top " style="height: 240px; width: auto; object-fit: contain;" src="<?=htmlspecialchars($product->productIMG)?>">
                                    <a type="button" class="icon-cardplus card-overlay">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </a>
                                    <div class="card-body text-center text-justify">
                                        <h5 class="card-title"><?=htmlspecialchars($product->productName)?></h5>
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
</main>

<?php include_once __DIR__ . '/../partials/footer.php' ?>

</body>
</html>