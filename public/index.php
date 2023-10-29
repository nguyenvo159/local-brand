<?php
require_once __DIR__ . '/../bootstrap.php';

use CT275\Labs\Product;
use CT275\Labs\Paginator;

$product = new Product($PDO);
$products = $product->all();

// $limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ? (int)$_GET['limit'] : 5;

// $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

// $paginator = new Paginator(
//     totalRecords: $product->count(),
//     recordsPerPage: $limit,
//     currentPage: $page
// );
// $products = $product->paginate($paginator->recordOffset, $paginator->recordsPerPage);

// $pages = $paginator->getPages(length: 3);

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
                        <img class="d-block w-100" src="https://bizweb.dktcdn.net/100/415/697/themes/902041/assets/slider_1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://bizweb.dktcdn.net/100/415/697/themes/902041/assets/slider_3.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://bizweb.dktcdn.net/100/415/697/themes/902041/assets/slider_5.jpg" alt="Third slide">
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
                <h1 class="mb-4">Áo</h1>
                <div class="row justify-content-start">
                    <!-- Card -->
                    <?php foreach ($products as $product):  ?>
                        <div class=" justify-content-center mb-3 col-lg-3 col-md-4 col-6 pr-3">
                            <div class="card-container">
                                <div class=" card">
                                    <img class="card-img-top " style="height: 240px; width: auto; object-fit: contain;" src="<?=htmlspecialchars($product->productIMG)?>">
                                    <a class="card-overlay">
                                        <i id="icon-cardplus" class="fa-solid fa-cart-plus"></i>
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
    </main>
    <?php include_once __DIR__ . '/../partials/footer.php' ?>

    
</body>
</html>