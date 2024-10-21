<?php
include "partials/header.php";
include "partials/navigation.php";

if (!is_user_logged_in()) {
  redirect();
}

$sql = "SELECT id, username, email, reg_date FROM users";
$result = mysqli_query($conn, $sql);




// var_dump($result);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  echo "<pre>";
  var_dump($_POST);
  echo "</pre>";
  if (isset($_POST['edit_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $new_email = mysqli_real_escape_string($conn, $_POST["email"]);

    //AVOID SQL INJECTION with prepared stmts
    $stmt = mysqli_prepare($conn, "UPDATE users SET email=?, username=? WHERE id=?");
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "ssi", $new_email, $username, $user_id);
      mysqli_stmt_execute($stmt);
      echo "updated successfulley";
      mysqli_stmt_close($stmt);
      $_SESSION['message'] = "User updated successfully";
      $_SESSION['msg_type'] = "success";
      redirect("admin.php");

      exit;
    } else {
      echo "stmt returns false";
    }
  }

  if (isset($_POST['delete_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
    $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE id=?");
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "i", $user_id);
      mysqli_stmt_execute($stmt);
      echo "deleted successfulley";
      mysqli_stmt_close($stmt);
      $_SESSION['message'] = "User deleted successfully";
      $_SESSION['msg_type'] = "success";
      redirect("admin.php");

      exit;
    } else {
      echo "stmt returns false";
    }


  }
}

?>
<h1>Manage Users</h1>

<div class="container">
  <?php if (isset($_SESSION["message"])): ?>
    <div class="notification <?= $_SESSION['msg_type']; ?>">
      <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
      unset($_SESSION['msg_type']);
      ?>
    </div>
  <?php endif; ?>
  <table class="user-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Registration Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($user = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $user['id'] ?></td>
          <td><?= $user['username'] ?></td>
          <td><?= $user['email'] ?></td>
          <td><?= full_month_date($user['reg_date']) ?></td>
          <td>
            <form method="POST" style="display:inline-block;">
              <input type="hidden" name="user_id" value="<?= $user["id"] ?>">
              <input type="text" name="username" value="<?= $user['username'] ?>" required>
              <input type="email" name="email" value="<?= $user["email"] ?>" required>
              <button class="edit" type="submit" name="edit_user">Edit</button>
            </form>
            <form method="POST" style="display:inline-block;"
              onsubmit="return confirm('Are you sure you want to delete this user?');">
              <input type="hidden" name="user_id" value="<?= $user["id"] ?>">
              <button class="delete" type="submit" name="delete_user">Delete</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>

      <!-- Additional user rows can go here -->
  </table>
</div>

<!-- Include Footer -->
<?php include "partials/footer.php"; ?>