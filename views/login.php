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
    <h2>Login</h2>
    <form action="../controllers/auth/login.php" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <?php if(isset($_GET['err'])) : ?>
            <div class="err">Email or password is invalid</div>
        <?php endif; ?>
        <input type="submit" value="Login">
    </form>
</div>
<?php
    require_once "../layouts/footer.php"
?>
