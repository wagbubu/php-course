<?php if (isset($_SESSION['message'])): ?>
  <div class="notification-container <?php echo isset($_SESSION['message']) ? "show" : "" ?> ">
    <div class="notification <?= $_SESSION['msg_type'] ?>">
      <?= $_SESSION['message'] ?>
      <?php unset($_SESSION['message']) ?>
      <!-- Success message will go here -->
    </div>
  </div>
<?php endif; ?>