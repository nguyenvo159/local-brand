<footer>
        <div class="container-fluid pt-5 mt-5 p-3 bg-dark text-white">
            <div class="row justify-content-center font-14px">
                <h4 class="col-10 mb-4 ml-5" style=" color: var(--main-color); letter-spacing: 2px;"><b>AMIRI -
                        LOCAL BRAND</b>
                </h4>

                <div class="col-md-4 col-12 row justify-content-center">
                    <div>
                        <h5 class=" mb-3">
                            <i class="fa-solid fa-location-dot fa-lg mr-1" style="color: #ffffff;"></i>
                            Hệ thống cửa hàng
                        </h5>
                        <p class="text-justify m-4"><b>TP Hồ Chí Minh</b> <br>
                            5 đường số 2, khu phố 2, phường Tam Bình, TP. Thủ Đức
                            182/13A Lê Văn Sỹ, Phường 10, quận Phú Nhuận.
                        </p>
                        <p class="text-justify m-4"><b>TP Cần Thơ</b> <br>
                            Ninh Kiều: 110/5/2 hẻm 5 đường Nguyễn Việt Hồng, Phường An Phú.
                        </p>

                    </div>
                </div>
                <div class="col-md-3 col-6 row justify-content-center">
                    <div>
                        <h4>Contact</h4>
                        <p><b>Theo dõi chúng tôi tại:</b> <br>

                            <a href="https://facebook.com/nguyenph2212/">
                                <i class="mt-3 mr-3 fa-brands fa-2x fa-facebook" style="color: #ffffff;"></i> </a>
                            <a href="https://www.instagram.com/v_p1202/">
                                <i class="mt-3 mr-3 fa-brands fa-2x fa-instagram" style="color: #ffffff;"></i> </a>
                            <a href="https://www.tiktok.com/">
                                <i class="mt-3 mr-3 fa-brands fa-2x fa-tiktok" style="color: #ffffff;"></i></a>
                            <a href="https://twitter.com/">
                                <i class="mt-3 mr-3 fa-brands fa-2x fa-twitter" style="color: #ffffff;"></i></a>
                            <a href="https://www.youtube.com/">
                                <i class="mt-3 mr-3 fa-brands fa-2x fa-youtube" style="color: #ffffff;"></i></a>
                        </p>
                        <p>
                            <i class="fa-solid fa-phone fa-lg mr-2" style="color: #ffffff;"></i>
                            <a href="tel:0763962680" style="text-decoration: underline; color: #ffffff;">
                                0763962680</a>
                        </p>

                        <p>
                            <i class=" fa-regular fa-envelope fa-lg mr-2" style="color: #ffffff;"></i>
                            <a href="mailto:nguyenvo1373.hg@gmail.com"
                                style="text-decoration: underline; color: #ffffff;">
                                nguyenvo1373.hg@gmail.com
                            </a>
                        </p>
                    </div>
                </div>
                <div class=" col-md-3 col-6 row justify-content-center">
                    <div>
                        <h4>About Us</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"> <a class="text-white text-decoration-none" href="/">Trang chủ</a></li>
                            <!-- <li class="mb-2"> <a class="text-white text-decoration-none" href="">Sale</a></li> -->
                            <li class="mb-2"> <a class="text-white text-decoration-none" href="/product.php">Sản phẩm</a></li>
                            <li class="mb-2"> <a class="text-white text-decoration-none" href="/about.php">Về chúng tôi</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-3 col-12 text-center">
                    <p>Copyright&copy; 2023 Local Brand Amiri. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous">
    </script>

<script>
    $(document).ready(function () {
        // Xử lý hiển thị thông báo lỗi đăng nhập
        <?php if (isset($_SESSION['login_error'])): ?>
            $('#loginError').removeClass('d-none').html('<strong><?php echo $_SESSION['login_error']; ?></strong>');
        <?php
            // Xóa thông báo lỗi từ session
            unset($_SESSION['login_error']);
        endif; ?>
    });
</script>
<script>
    $(document).ready(function () {
        
    });
</script>

<script>
    $(document).ready(function() {

        // Hiển thị Toast khi nhấn vào icon
        $('.icon-cardplus').click(function () {
            $('#addToCartToast').toast('show');
        });
        $('.addFromDetai').click(function () {
            $('#addToCartToast').toast('show');
        });

        // Xem chi tiết sản phẩm
        $('.card-title').on('click', function () {
            var productId = $(this).data('product-id');
            
            window.location.href = '/detail.php?id=' + productId;
        });

        $('.icon-cardplus').click(function() {
            // Kiểm tra đăng nhập
            <?php if (isset($_SESSION['user_id'])) : ?>
                var productId = $(this).closest('.card-container').find('.card-title').data('product-id');
                addToCart(productId, 1);
            <?php else : ?>
                window.location.href = '/auth/login.php';
            <?php endif; ?>
        });
        function addToCart(productId, quantity) {
            // Thực hiện thêm vào giỏ hàng bằng Ajax
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
        }
    });
</script>
<script src="/js/main.js"></script>