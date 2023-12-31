<?php
require_once __DIR__ . '/../bootstrap.php';

use CT275\Labs\Product;
use CT275\Labs\Paginator;
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php'); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    exit();
}
elseif ($_SESSION['user_id']!= 1){
    header('Location: /'); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    exit();
}   


$product = new Product($PDO);
// $products = $product->all();

if(isset($_POST['type']) && $_POST['type'] !=0){
    $type = $_POST['type'];
    
    $products = $product->getByCategory($type);
}

else{
    $limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ? (int)$_GET['limit'] : 10;

    $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

    $paginator = new Paginator(
        totalRecords: $product->count(),
        recordsPerPage: $limit,
        currentPage: $page
    );
    $products = $product->paginate($paginator->recordOffset, $paginator->recordsPerPage);

    $pages = $paginator->getPages(length: 3);
}

include_once __DIR__ . '/../partials/head.php';
?>

<body>

<?php include_once __DIR__ . '/../partials/navbar.php' ?>

    <!-- Main Page Content -->
    <div class="container-fluid">
        <h2 class="mt-3 text-center">Quản lý Sản Phẩm</h2>
        <p class="text-center">Dưới đây là toàn bộ sản phẩm.</p>
        <div class="row w-100">
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-12">

                <a href="/add.php" class="btn btn-primary mb-3">
                    <i class="fa fa-plus"></i> Thêm sản phẩm
                </a>
                    <form action="/manager.php" method="post">
                        <div class="mb-3 d-flex justify-content-start align-items-center">
                            <label for="type">Sắp xếp theo </label>
                            <select name="type" id="type" class="ml-2 pt-0 pb-0 rounded-0 form-control" style="width: 110px; height: 38px;">
                                <option class="rounded-0" value="0" <?= isset($type) && $type == 0 ? 'selected' : '' ?>>--</option>
                                <option class="rounded-0" value="1" <?= isset($type) && $type == 1 ? 'selected' : '' ?>>Áo</option>
                                <option class="rounded-0" value="2" <?= isset($type) && $type == 2 ? 'selected' : '' ?>>Quần</option>
                                <option class="rounded-0" value="3" <?= isset($type) && $type == 3 ? 'selected' : '' ?>>Phụ kiện</option>
                            </select>
                            <button class="ml-2 btn btn-success rounded-0" type="submit" style="height: 38px;">Lọc</button>
                        </div>
                    </form>

                <!-- Table Starts Here -->
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Ảnh</th>
                            <th scope="col">Tên</th>
                            <!-- <th scope="col">Loại</th> -->
                            <th scope="col">Giá</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Ngày Tạo</th>
                            <th scope="col">Ngày sửa</th>
                            <th class="text-center" scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product): ?>
                            <tr>
                                <td class="align-middle text-center">
                                    <img class="img-fluid bg-transparent" src="<?=htmlspecialchars($product->productIMG)?>" alt=""
                                        style="height: auto; width: 100px;">
                                </td>
                                <td class="align-middle">
                                    <i> <?=htmlspecialchars($product->productName)?></i> <br> 
                                </td>
                                <td class="align-middle"><i>$<?=htmlspecialchars($product->price)?></td> </i></td>
                                <td class="align-middle"><?= empty($product->description) ? "Sản phẩm không có mô tả." : htmlspecialchars($product->description) ?></td>
                                <td class="align-middle"><i><?=date("<b>H:i</b> <br> d/m/Y", strtotime($product->created_at))?></i></td>
                                <td class="align-middle"><i><?=date("<b>H:i</b> <br> d/m/Y", strtotime($product->updated_at))?></i></td>
                                
                                <td class="d-flex justify-content-center align-items-center" style="height: 125px;">
                                    <a href="<?='/edit.php?id=' . $product->getId()?>" class="btn btn-xs btn-warning">
                                        <i alt="Edit"  class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    
                                    <form class="form-inline ml-1" action="/delete.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $product->getId() ?>">
                                        <button type="submit" class="btn btn-xs btn-danger" name="delete-product">
                                            <i alt="Delete" class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <!-- Table Ends Here -->
                <div id="delete-confirm" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Vui lòng xác nhận</h4>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">Bạn có thực sự muốn xóa sản phẩm?</div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-primary">Hủy</button>
                                <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Xóa</button>
                            </div>
                        </div>
                    </div>
                </div>
		        <!-- Pagination -->
                <?php if (!isset($type) || $type == 0) :?>
                <nav class="d-flex justify-content-center">
                    <ul class="pagination">
                        <li class="page-item<?= $paginator->getPrevPage() ? '' : ' disabled' ?>">
                            <a role="button" href="/manager.php/?page=<?= $paginator->getPrevPage() ?>&limit=<?= $limit ?>" class="page-link">
                                <span>&laquo;</span>
                            </a>
                        </li>
                        <?php foreach ($pages as $page) : ?>
                            <li class="page-item<?= $paginator->currentPage === $page ? ' active' : '' ?>">
                                <a role="button" href="/manager.php/?page=<?= $page ?>&limit=<?= $limit ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endforeach ?>
                        <li class="page-item<?= $paginator->getNextPage() ? '' : ' disabled' ?>">
                            <a role="button" href="manager.php/?page=<?= $paginator->getNextPage() ?>&limit=<?= $limit ?>" class="page-link">
                                <span>&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <?php endif ?>
            </div>
        </div>
    </div>

    

    <?php include_once __DIR__ . '/../partials/footer.php' ?>
    <script>
        $(document).ready(function() {
            $('button[name="delete-product"]').on('click', function(e){
                e.preventDefault();

                const form = $(this).closest('form');
                const nameTd = $(this).closest('tr').find('td:eq(1)');
                
                
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