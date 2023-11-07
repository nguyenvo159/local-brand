<?php
require_once __DIR__ . '/../bootstrap.php';
use CT275\Labs\OrderDetail;
use CT275\Labs\Product;


session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php'); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    exit();
}
elseif ($_SESSION['user_id']!= 1){
    header('Location: /'); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    exit();
}  


$orders = $orderRepository->getAllOrdersInDB();


include_once __DIR__ . '/../partials/head.php';


?>

<body>
<?php include_once __DIR__ . '/../partials/navbar.php' ?>

<main>
    <div class ="container mt-3">
        <h1 class="mb-3" >Quản lý đơn hàng</h1>
        
        <div class="row">   
            <?php foreach ( $orders as $order): 
                $orderDetails = $order->getOrderDetail();
                ?>        
                
                    <div class="col-10 p-0 offset-1 border-bottom">
                        <div class="card rounded-0 mt-3 flex-row">
                            <div class="p-2 card-body position-relative">
                                <div class="pt-2 w-100 d-flex justify-content-between">
                                    <p><b>Mã đơn: </b><?= $order->getOrderID() ?></p>
                                    <p><i><?=date("<b>H:i</b> <br> d/m/Y", strtotime($order->getOrderDate()))?></i></p>

                                    <a class="" data-toggle="collapse" href="#collapse<?= $order->getOrderID()?>" role="button" aria-expanded="false" aria-controls="collapse<?= $order->getOrderID()?>">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </a>
                                </div>
                                <p><b>ID:</b> <i><?= htmlspecialchars($order->getUserID())?></i></p>
                                <p><b>Người đặt:</b> <i><?= htmlspecialchars($order->getName())?>, 
                                    <?= htmlspecialchars($order->getPhone())?></i>
                                </p> 
                                <p><b>Địa chỉ:</b> <i><?= htmlspecialchars($order->getAddress())?></i></p>
                                <div class ="position-absolute" style="right: 5%; top:10%;">
                                    <form action="/deleteOrder.php" method="post">
                                        <input type="hidden" name="orderID" value="<?= htmlspecialchars($order->getOrderID())?>">
                                        <a class="text-dark text-decoration-none" name="delete-order" type="submit" href=""><i>Hủy đơn hàng</i></a>
                                    </form>
                                </div>
                                <div class="position-absolute" style="right: 10px; bottom: 10px">
                                    <p><i class="price">$<?= $order->getTotalAmount() ?></i></p>
                                </div>
                            </div>
                                                
                        </div> 
                    </div>
                    <div class="col-10 offset-1 p-0 d-flex justify-content-center">
                        <div class="collapse w-100 " id="collapse<?= $order->getOrderID()?>">
                            
                           
                        
                        <!-- Các oderDetail -->
                            
                            <?php foreach ($orderDetails as $orderDetail): 
                                $product = new Product($PDO);
                                $product = $product->find($orderDetail->getProductID());
                                $quantity = $cartRepository->getQuantityByProductId($_SESSION['user_id'],$orderDetail->getProductID());
                            ?>              
                                <div class="card mt-1 rounded-0 flex-row " data-product-id="<?=htmlspecialchars($product->getId())?>">
                                    <div class="card-img-left d-flex align-items-center">
                                        <img src="<?=htmlspecialchars($product->productIMG)?>"
                                            style="width:80px; height: 80px; object-fit: contain;" class="img-fluid"
                                            alt="Ảnh sản phẩm">
                                    </div>
                                    <div class="p-2 card-body position-relative">
                                        <strong class="card-title main-hover" data-product-id="<?= htmlspecialchars($product->getId()) ?>"><?=htmlspecialchars($product->productName)?></strong>
                                        <p class="price card-text"> <i>$<?=htmlspecialchars($product->price)?></i> </p>
                                                
                                        <div class="position-absolute" style="right: 20px; bottom: 10%;">
                                            <p class="" data-product-id="<?=htmlspecialchars($product->getId())?>">x<?=htmlspecialchars($orderDetail->getQuantity())?></p>
                                        </div>
                                    </div>
                                                
                                </div>
                            <?php endforeach ?>
                            <hr class="custom-hr border-2 bg-dark">
                        </div>
                    </div>

            <?php endforeach ?>
  
       
        </div>
    </div>
    <div id="delete-confirm" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Vui lòng xác nhận</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">Bạn có thực sự muốn xóa đơn hàng này?</div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary">Hủy</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Xóa</button>
                </div>
            </div>
        </div>
    </div>
</main>    
<!-- Modal delete -->


<?php include_once __DIR__ . '/../partials/footer.php' ?>
<script>
        $(document).ready(function() {
            $('a[name="delete-order"]').on('click', function(e){
                e.preventDefault();

                const form = $(this).closest('form');                
                
                $('#delete-confirm').modal({
                    backdrop: 'static', keyboard: false
                })
                .one('click', '#delete', function() {
                    form.trigger('submit');
                });
            });
        });
    </script>
</body>
</html>