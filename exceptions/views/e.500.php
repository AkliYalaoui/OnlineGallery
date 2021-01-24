<?php
    $src = "../../src/css/styles.css";
    require_once "../../layouts/header.php"
?>
<div class="e-err">
    <section>
        <h1>500 server error</h1>
        <p>please try again or contact support. <a href="<?= $_SERVER['HTTP_REFERER'] ?? '#' ?>">Go Back</a> </p>
    </section>
</div>

<?php
    require_once "../../layouts/footer.php"
?>