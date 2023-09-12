<?php
    include 'partials/header.php';

?>
<section class="form__section">
        <div class="container form__container">
            <h2>Add Category</h2>
            <?php if(isset($_SESSION['add-category'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category']); ?>
                </p>
            </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">
                <input type="text" name="title" placeholder="Title">
                <textarea rows="4" name="description" placeholder="Description"></textarea>
                <button type="submit" name="submit" class="btn">Add Category</button>
            </form>
        </div>
    </section>

<?php
    include '../partials/footer.php';
?>