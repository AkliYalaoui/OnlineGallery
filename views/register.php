<?php
    session_start();
    if(isset($_SESSION['id'])){
        header('Location:gallery.php');
        exit;
    }
    require_once "../layouts/header.php";
    require_once "../layouts/nav.php";
?>

<div class="auth-container">
    <h2>Register</h2>
    <form action="../controllers/auth/register.php" method="post">

        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?= $_GET['old_name'] ?? '' ?>">
        <?php if(isset($_GET['err_type']) && $_GET['err_type'] === "name") : ?>
            <div class="err"> <?= urldecode($_GET['err_msg']) ?></div>
        <?php endif; ?>

        <label for="email">email</label>
        <input type="email" name="email" id="email"  value="<?= $_GET['old_email'] ?? '' ?>">
        <?php if(isset($_GET['err_type']) && $_GET['err_type'] === "email") : ?>
            <div class="err"> <?= urldecode($_GET['err_msg']) ?></div>
        <?php endif; ?>

        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <?php if(isset($_GET['err_type']) && $_GET['err_type'] === "password") : ?>
            <div class="err"> <?= urldecode($_GET['err_msg']) ?></div>
        <?php endif; ?>

        <input type="submit" value="Register">
    </form>
</div>
<?php
require_once "../layouts/footer.php"
?>

