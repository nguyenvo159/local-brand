<?php 
require_once __DIR__ . '/../../bootstrap.php';

use CT275\Labs\Product;

$product = new Product($PDO);

$products = $product->getByCategory(3);


include_once __DIR__ . '/../../partials/head.php';
?>

<body>
<?php include_once __DIR__ . '/../../partials/navbar.php' ?>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-10 offset-1">
                <h4 class="mt-3 mb-3">Sản phẩm / Phụ kiện</h4>

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

<?php include_once __DIR__ . '/../../partials/footer.php' ?>

</body>
</html>