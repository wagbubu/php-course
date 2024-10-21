<nav>
    <ul>
        <li>
            <a class="<?php echo setActiveCLass('index.php');  ?>"  href="index.php">Home</a></li>

        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <li>
                <a href="admin.php">Admin</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
        <?php else: ?>
            <li>
                <a class="<?php echo setActiveCLass('register.php');  ?>"  href="register.php">Register</a>
            </li>
            <li>
                <a class="<?php echo setActiveCLass('login.php');  ?>" href="login.php">Login</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>