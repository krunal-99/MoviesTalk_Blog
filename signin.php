<?php
require 'config/constants.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoviesTalk</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <section class="form__section">
        <div class="container form__container">
            <h2>Sign In</h2>
            <?php if(isset($_SESSION['signup-success'])) : ?>
            <div class="alert__message success">
                <p>
                    <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']); 
                    ?>
                </p>
            </div>
            <?php elseif(isset($_SESSION['signin'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['signin'];
                        unset($_SESSION['signin']); 
                    ?>
                </p>
            </div>
            <?php endif ?>
            <form action="<?= ROOT_URL?>signin-logic.php" method="POST">
                <input type="text" value="<?=$username_email ?>" name="username_email" placeholder="Username Or Email">
                <input type="password" value="<?=$password?>" name="password" placeholder="Enter Your Password">
                <button type="submit" name="submit" class="btn">Sign In</button>
                <small>Don't have an account? <a href="signup.php">Sign Up</a></small>
            </form>
        </div>
    </section>
</body>
</html>