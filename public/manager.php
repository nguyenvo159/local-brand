<?php
require_once __DIR__ . '/../bootstrap.php';

use CT275\Labs\Product;
use CT275\Labs\Paginator;

$product = new Product($PDO);
// $products = $product->all();

$limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ? (int)$_GET['limit'] : 5;

$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

$paginator = new Paginator(
    totalRecords: $product->count(),
    recordsPerPage: $limit,
    currentPage: $page
);
$products = $product->paginate($paginator->recordOffset, $paginator->recordsPerPage);

$pages = $paginator->getPages(length: 3);

include_once __DIR__ . '/../partials/header.php';
?>

<body>

<?php include_once __DIR__ . '/../partials/navbar.php' ?>

    <!-- Main Page Content -->
    <div class="container">
        <h2 class="mt-3 text-center">Quản lý Sản Phẩm</h2>
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <p>Dưới đây là toàn bộ sản phẩm.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">

                <a href="/add.php" class="btn btn-primary mb-3">
                    <i class="fa fa-plus"></i> New Contact
                </a>

                <!-- Table Starts Here -->
                <table id="contacts" class="table  table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product): ?>
                            <tr>
                                <td class="text-center">
                                    <img class="img-fluid bg-transparent" src="<?=htmlspecialchars($product->productIMG)?>" alt=""
                                        style="height: 100px; width: auto;">
                                    </td>
                                <td class="align-middle"><?=htmlspecialchars($product->productName)?></td>
                                <td class="align-middle"><?=htmlspecialchars($product->price)?></td>
                                <td class="align-middle"><?=date("d-m-Y", strtotime($product->created_at))?></td>
                                <td class="align-middle"><?=htmlspecialchars($product->description)?></td>
                                
                                <td class="d-flex justify-content-center align-items-center" style="height: 125px;">
                                    <a href="<?='/edit.php?id=' . $product->getId()?>" class="btn btn-xs btn-warning">
                                        <i alt="Edit" class="fa fa-pencil"></i> Edit
                                    </a>
                                    
                                    <form class="form-inline ml-1" action="/delete.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $product->getId() ?>">
                                        <button type="submit" class="btn btn-xs btn-danger" name="delete-contact">
                                            <i alt="Delete" class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <!-- Table Ends Here -->

		        <!-- Pagination -->
                <nav class="d-flex justify-content-center">
                    <ul class="pagination">
                        <li class="page-item<?= $paginator->getPrevPage() ? '' : ' disabled' ?>">
                            <a role="button" href="manager.php/?page=<?= $paginator->getPrevPage() ?>&limit=5" class="page-link">
                                <span>&laquo;</span>
                            </a>
                        </li>
                        <?php foreach ($pages as $page) : ?>
                            <li class="page-item<?= $paginator->currentPage === $page ? ' active' : '' ?>">
                                <a role="button" href="manager.php/?page=<?= $page ?>&limit=5" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endforeach ?>
                        <li class="page-item<?= $paginator->getNextPage() ? '' : ' disabled' ?>">
                            <a role="button" href="manager.php/?page=<?= $paginator->getNextPage() ?>&limit=5" class="page-link">
                                <span>&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div id="delete-confirm" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">Do you want to delete this contact?</div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../partials/footer.php' ?>
    <script>
        $(document).ready(function() {
            $('button[name="delete-contact"]').on('click', function(e){
                e.preventDefault();

                const form = $(this).closest('form');
                const nameTd = $(this).closest('tr').find('td:eq(1)');
                
                if (nameTd.length > 0) {
                    $('.modal-body').html(`Do you want to delete "${nameTd.text()}"?`);
                }
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