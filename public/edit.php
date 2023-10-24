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
        redirect('/');
    }
    $errors = $product->getValidationErrors();
}

include_once __DIR__ . '/../partials/header.php';
?>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php' ?>

    
    <div class="container">
        <h2 class="mt-3 text-center">Cập nhật Sản Phẩm</h2>
        <p class="text-center">Vui lòng điền đúng thông tin muốn cập nhật.</p>
        <div class="row">
            <div class="col-12">

                <form method="post" class="col-md-6 offset-md-3">

                    <input type="hidden" name="id" value="<?= $contact->getId() ?>">

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control<?= isset($errors['name']) ? ' is-invalid' : '' ?>" maxlen="255" id="name" placeholder="Enter Name" value="<?= $contact->name ?>" />

                        <?php if (isset($errors['name'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['name'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" class="form-control<?= isset($errors['phone']) ? ' is-invalid' : '' ?>" maxlen="255" id="phone" placeholder="Enter Phone" value="<?= $contact->phone ?>" />

                        <?php if (isset($errors['phone'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['phone'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Notes -->
                    <div class="form-group">
                        <label for="notes">Notes </label>
                        <textarea name="notes" id="notes" class="form-control<?= isset($errors['notes']) ? ' is-invalid' : '' ?>" placeholder="Enter notes (maximum character limit: 255)"><?= $contact->notes ?></textarea>

                        <?php if (isset($errors['notes'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['notes'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Submit -->
                    <button type="submit" name="submit" class="btn btn-primary">Update Contact</button>
                </form>

            </div>
        </div>

    </div>

    <?php include_once __DIR__ . '/../partials/footer.php' ?>
</body>

</html>