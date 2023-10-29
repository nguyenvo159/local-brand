<?php
require_once __DIR__ . '/../bootstrap.php';

use CT275\Labs\Product;

$errors = [];

// Khi xác nhận Thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $product = new Product($PDO);
    $product->fill($_POST);
    
    if ($product->validate()) {
        $product->save() && redirect('/manager.php');
    }
    $errors = $product->getValidationErrors();
}

include_once __DIR__ . '/../partials/head.php';
?>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php' ?>

    <!-- Main Page Content -->
    <div class="container">
        <h2 class="mt-3 text-center">Thêm Sản Phẩm</h2>
        <p class="text-center">Vui lòng nhập đúng các thông tin Sản Phẩm muốn thêm.</p>
        <div class="row">
            <div class="col-12">

                <form method="post" class="col-md-6 offset-md-3">

                    <!-- Tên sản phẩm -->
                    <div class="form-group">
                        <label for="productName">Tên Sản Phẩm</label>
                        <input type="text" name="productName" id="productName" class="form-control<?= isset($errors['productName']) ? ' is-invalid' : '' ?>" maxlength="255"  
                            placeholder="Nhập tên sản phẩm" value="<?= isset($_POST['productName']) ? $_POST['productName'] : '' ?>" />

                        <?php if (isset($errors['productName'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['productName'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>
                    
                    <!-- Loại sản phẩm -->
                    <div class="form-group">
                        <label for="categoryID">Category</label>
                        <select name="categoryID" id="categoryID" class="form-control<?= isset($errors['categoryID']) ? ' is-invalid' : '' ?>">
                            <option value="1" <?= (isset($_POST['categoryID']) && $_POST['categoryID'] == 1) ? 3 : '' ?>>Áo</option>
                            <option value="2" <?= (isset($_POST['categoryID']) && $_POST['categoryID'] == 2) ? 3 : '' ?>>Quần</option>
                            <option value="3" <?= (isset($_POST['categoryID']) && $_POST['categoryID'] == 3) ? 3 : '' ?>>Khác</option>
                        </select>

                        <?php if (isset($errors['categoryID'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['categoryID'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Giá sản phẩm -->
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="text" name="price" id="price" class="form-control<?= isset($errors['price']) ? ' is-invalid' : '' ?>"  
                            placeholder="Nhập giá" value="<?= isset($_POST['price']) ? $_POST['price'] : '' ?>" />

                        <?php if (isset($errors['price'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['price'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>
                    
                    <!-- IMG URL sản phẩm -->
                    <div class="form-group">
                        <label for="productIMG">Product Image URL</label>
                        <input type="text" name="productIMG" id="productIMG" class="form-control<?= isset($errors['productIMG']) ? ' is-invalid' : '' ?>" 
                             placeholder="Nhập địa chỉ ảnh" value="<?= isset($_POST['productIMG']) ? $_POST['productIMG'] : '' ?>" />

                        <?php if (isset($errors['productIMG'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['productIMG'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea name="description" id="description" class="form-control<?= isset($errors['description']) ? ' is-invalid' : '' ?>" 
                            placeholder="Không bắt buộc..."><?= isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>

                        <?php if (isset($errors['description'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['description'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Submit -->
                    <button type="submit" name="submit" class="btn btn-primary">Add Contact</button>
                </form>

            </div>
        </div>

    </div>

    <?php include_once __DIR__ . '/../partials/footer.php' ?>
</body>

</html>