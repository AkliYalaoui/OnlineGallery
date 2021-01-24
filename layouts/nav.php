<header class="nav-bar-green">
    <div class="container">
        <nav class="nav-bar">
            <h1>
                <a href="gallery.php">Online Gallery</a>
            </h1>
            <ul>
                <?php if (!isset($_SESSION['id'])): ?>
                <li>
                    <a href="login.php">login</a>
                </li>
                <li>
                    <a href="register.php">signup</a>
                </li>
                <?php else: ?>
                <li>
                    <button id="import-button">import <strong>+</strong></button>
                </li>
                <li>
                    <form action="../controllers/auth/logout.php" method="post">
                        <button type="submit">logout</button>
                    </form>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
