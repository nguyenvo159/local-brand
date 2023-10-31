<?php
require_once __DIR__ . '/../bootstrap.php';

use CT275\Labs\Product;

$product = new Product($PDO);

$id = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;

if ($id < 0 || !($product->find($id))) {
    redirect('/');
}

$errors = [];

// Khi Xác nhận Cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($product->update($_POST)) {
        redirect('/manager.php');
    }
    $errors = $product->getValidationErrors();
}

include_once __DIR__ . '/../partials/head.php';
?>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php' ?>

    
    <div class="container">
        <h2 class="mt-3 text-center">Cập nhật Sản Phẩm</h2>
        <p class="text-center">Vui lòng điền đúng thông tin muốn cập nhật.</p>
        <div class="container">
            <div class="row justify-content-center">
                    <form method="post" class="col-lg-6 col-8">

                        <input type="hidden" name="id" value="<?= $product->getId() ?>">

                        <!-- Tên sản phẩm -->
                        <div class="form-group">
                            <label for="productName">Tên Sản Phẩm</label>
                            <input type="text" name="productName" class="form-control<?= isset($errors['productName']) ? ' is-invalid' : '' ?>" maxlength="255" 
                                id="productName" value="<?= htmlspecialchars($product->productName)  ?>" />

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
                                <option value="1" <?= ($product->categoryID == 1) ? 'selected' : '' ?>>Áo</option>
                                <option value="2" <?= ($product->categoryID == 2) ? 'selected' : '' ?>>Quần</option>
                                <option value="3" <?= ($product->categoryID == 3) ? 'selected' : '' ?>>Phụ kiện</option>
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
                            <input type="text" name="price" class="form-control<?= isset($errors['price']) ? ' is-invalid' : '' ?>" id="price" 
                                value="<?= htmlspecialchars($product->price) ?>" />

                            <?php if (isset($errors['price'])) : ?>
                                <span class="invalid-feedback">
                                    <strong><?= $errors['price'] ?></strong>
                                </span>
                            <?php endif ?>
                        </div>
                        
                        <!-- IMG URL sản phẩm -->
                        <div class="form-group">
                            <label for="productIMG">Product Image URL</label>
                            <input type="text" name="productIMG" class="form-control<?= isset($errors['productIMG']) ? ' is-invalid' : '' ?>" id="productIMG" 
                                value="<?= htmlspecialchars($product->productIMG) ?>"/>

                            <?php if (isset($errors['productIMG'])) : ?>
                                <span class="invalid-feedback">
                                    <strong><?= $errors['productIMG'] ?></strong>
                                </span>
                            <?php endif ?>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea name="description" id="description" class="form-control<?= isset($errors['description']) ? ' is-invalid' : '' ?>"><?= htmlspecialchars($product->description) ?></textarea>

                            <?php if (isset($errors['description'])) : ?>
                                <span class="invalid-feedback">
                                    <strong><?= $errors['description'] ?></strong>
                                </span>
                            <?php endif ?>
                        </div>
                        <!-- Submit -->
                        <button type="submit" name="submit" class="btn btn-primary">Cập Nhập Sản Phẩm</button>
                    </form>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../partials/footer.php' ?>
</body>

</html>