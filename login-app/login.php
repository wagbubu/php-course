<?php
include "partials/header.php";
include "partials/navigation.php";
$error = "";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  header('Location: admin.php');
  exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);
  //query user input to si if it exist
  $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  $result = mysqli_query($conn, $sql);
  //check if user exist
  if ($result->num_rows) {
    $user = mysqli_fetch_assoc($result);
    //check if password match with the hashed password in the database
    $passwordMatch = password_verify($password, $user['password']);
    if ($passwordMatch) {
      $_SESSION['logged_in'] = true;
      $_SESSION['username'] = $user['username'];
      header("Location: admin.php");
      //exit script so that after redirection it wont continue running 
      exit;
      //throw errors dont give clues if password or username are incorrect
    } else {
      $error = "username or password is incorrect";
    }
    //throw errors dont give clues if password or username are incorrect
  } else {
    $error = "username or password is incorrect";
  }
}
?>

<div class="container">
  <div class="form-container">
    <form method="POST" action="">
      <h2>Login</h2>
      <?php if ($error): ?>
        <!-- Error message placeholder -->
        <p style="color:red">
          <!-- Error message goes here -->
          <?= $error ?>
        </p>
      <?php endif; ?>

      <label for="username">Username:</label><br>
      <input type="text" name="username" required><br><br>

      <label for="password">Password:</label><br>
      <input type="password" name="password" required><br><br>

      <input type="submit" value="Login">
    </form>
  </div>
</div>

<!-- Include Footer -->
<?php include "partials/footer.php"; ?>