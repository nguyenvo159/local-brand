<?php 
require_once __DIR__ . '/../bootstrap.php';
use CT275\Labs\Product;

$product = new Product($PDO);

if (isset($_GET['key'])) {
    $searchQuery = trim($_GET['key']);
    if (empty($searchQuery)) {
        $searchError = 'Không có dữ liệu tìm kiếm được gửi.'; 
        $products=[];

    }
    else{
        $products = $product->searchProduct($searchQuery);
        if (empty($products)) {
            $searchError = 'Không có kết quả tìm kiếm nào.';
        }
    }

    
    
    
} 

include_once __DIR__ . '/../partials/head.php';
?>

<body>
<?php include_once __DIR__ . '/../partials/navbar.php' ?>
    <!-- Toasts -->
    
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="pb-5 col-10 offset-1">
                <h2 class="mt-5 mb-5">Kết quả tìm kiếm: </h2>
                <div class="d-flex justify-content-center align-items-center">
                    <span><?php echo isset($searchError) ? $searchError : ''; ?></span>
                </div>
                <div class="row justify-content-start">
                    <!-- Card -->
                    <?php foreach ($products as $product):  ?>
                        <div class=" justify-content-center mb-3 col-lg-3 col-md-4 col-6 pr-3">
                            <div class="card-container">
                                <div class="card border-0 ">
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
</main>

<?php include_once __DIR__ . '/../partials/footer.php' ?>

</body>
</html>