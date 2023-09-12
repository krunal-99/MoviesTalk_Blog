<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoviesTalk</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head> -->


<?php
include 'partials/header.php';
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
unset($_SESSION['add-user-data']);
?>
<body>
    <section class="form__section">
        <div class="container form__container">
            <h2>Add User</h2>
            <?php if(isset($_SESSION['add-user'])) : ?>
                <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-user'];
                    unset($_SESSION['add-user']) ?>
                </p>
            </div>

            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" value="<?= $firstname?>" name="firstname" placeholder="First Name">
                <input type="text" value="<?= $lastname?>" name="lastname" placeholder="Last Name">
                <input type="text" value="<?= $username?>" name="username" placeholder="User Name">
                <input type="email" value="<?= $email?>" name="email" placeholder="Email">
                <input type="password" value="<?= $createpassword?>" name="createpassword" placeholder="Create Password">
                <input type="password" value="<?= $confirmpassword?>" name="confirmpassword" placeholder="Confirm Password">
                <select name="userrole">
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>
                <div class="form__control">
                    <label for="avatar">User Avatar</label>
                    <input type="file" id="avatar" name="avatar">
                </div>
                <button type="submit" name="submit" class="btn">Add User</button>
            </form>
        </div>
    </section>
</body>
</html>