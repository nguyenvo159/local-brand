<?php
require_once __DIR__ . '/../bootstrap.php';

use CT275\Labs\Product;
use CT275\Labs\Paginator;

$product = new Product($PDO);
$products_shirt = $product->getByCategory(1);
$products_pant = $product->getByCategory(2);
$products_other = $product->getByCategory(3);



include_once __DIR__ . '/../partials/head.php';
?>


<body>
    <?php include_once __DIR__ . '/../partials/navbar.php' ?>

    <main>
        <div class="container-fluid  p-0">
            <!-- Carousel Slider -->
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img style="height: 800px; width: 100%; object-fit: cover" class="d-block w-100" src="https://amiri.com/cdn/shop/files/DESKTOP_-slideshow-banner_desktop_core.png" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img style="height: 800px; width: 100%; object-fit: cover" class="d-block w-100" src="https://amiri.com/cdn/shop/files/Slideshow-Banner_Desktop_AW23-Mens-6D.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img style="height: 800px; width: 100%; object-fit: cover" class="d-block w-100" src="https://amiri.com/cdn/shop/files/Slideshow-Banner_Desktop_AW23-Womens-1.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <br><br>
            <div class="container-fluid mt-5 mb-5 d-flex justify-content-center">
                <div class="row justify-content-center align-items-center w-50">
                    <h2>Enjoy Your Youth!</h2>
                    <div class="col-12 text-center text-justify">
                        <p class="">Không chỉ là thời trang, Amiri còn là “phòng thí nghiệm” của tuổi trẻ - nơi
                            nghiên cứu và cho ra đời nguồn năng lượng mang tên “Youth”. Chúng mình luôn muốn tạo nên
                            những trải nghiệm vui vẻ, năng động và trẻ trung.</p>
                        <br>
                    </div>
                </div>
                <br><br><br><br>
            </div>
        </div>

        <div class="container">
            <!-- Áo -->
            <div id="shirt" class="mb-5">
                <a class="main-hover text-decoration-none" href="/product/shirts.php"><h2 class="mb-4">Áo</h2></a>
                <div class="row justify-content-start">
                    <!-- Card -->
                    <?php 
                    $limitedProducts = array_slice($products_shirt, 0, 7);
                    foreach ($limitedProducts as $product):  ?>
                        <div class=" justify-content-center mb-3 col-lg-3 col-md-4 col-6 pr-3">
                            <div class="card-container">
                                <div class="card border-0">
                                    <img class="card-img-top " style="height: 240px; width: auto; object-fit: contain;" src="<?=htmlspecialchars($product->productIMG)?>">
                                    <a type="button" class="icon-cardplus card-overlay">
                                        <i  class="fa-solid fa-cart-plus"></i>
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
                    <div class=" justify-content-center mb-3 col-lg-3 col-md-4 col-6 pr-3">
                        <div class="d-flex justify-content-center align-items-center" style="height:100%;">
                            <h4> 
                                <a class="main-hover text-decoration-underline" href="/product/shirts.php" > Xem thêm</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quần -->
            <div id="pant" class="mb-5">
                <a class="main-hover text-decoration-none" href="/product/pants.php"><h2 class="mb-4">Quần</h2></a>
                <div class="row justify-content-start">
                    <!-- Card -->
                    <?php 
                    $limitedProducts = array_slice($products_pant, 0, 7);
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
                    <div class=" justify-content-center mb-3 col-lg-3 col-md-4 col-6 pr-3">
                        <div class="d-flex justify-content-center align-items-center" style="height:100%;">
                            <h4> 
                                <a class="main-hover text-decoration-underline" href="/product/pants.php" > Xem thêm</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Phụ kiện -->
            <div id="other" class="mb-5">
                <a class="main-hover text-decoration-none" href="/product/others.php"><h2 class="mb-4">Phụ kiện</h2></a>
                <div class="row justify-content-start">
                    <!-- Card -->
                    <?php 
                    $limitedProducts = array_slice($products_other, 0, 7);
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
                    <div class=" justify-content-center mb-3 col-lg-3 col-md-4 col-6 pr-3">
                        <div class="d-flex justify-content-center align-items-center" style="height:100%;">
                            <h4> 
                                <a class="main-hover text-decoration-underline" href="/product/others.php" > Xem thêm</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
    
    <?php include_once __DIR__ . '/../partials/footer.php' ?>

</body>
</html>