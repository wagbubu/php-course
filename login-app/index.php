<?php
include "partials/header.php";
include "partials/navigation.php";
?>
<div class="container">
  <div class="hero">
    <div class="hero-content">
      <h1>Welcome to our PHP App</h1>
      <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <h1><?= $_SESSION['username'] ?></h1>
      <?php else: ?>
        <p>Securely login and manage your account with us</p>
        <div class="hero-buttons">
          <a class="btn" href="login.php">Login</a>
          <a class="btn" href="register.php">Register</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php include "partials/footer.php"; ?>