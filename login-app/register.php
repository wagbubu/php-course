<?php
include "partials/header.php";
include "partials/navigation.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);
  $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);
  //check if password matches the password confirmation
  if ($password !== $confirm_password) {
    $error = "Password don't match!";
  } else {
    //check if the user already exist
    //if user does not exist yet then continue to create a new user
    if (!user_exists($conn, $username)) {
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);

      $stmt = mysqli_prepare($conn, "INSERT into users(username, password, email)  VALUES (?, ?, ?)");
      if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $username, $passwordHash, $email);
        mysqli_stmt_execute($stmt);

        echo "user added successfulley";

        mysqli_stmt_close($stmt);
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: admin.php");
      } else {
        echo "error stmt returns false";
      }
      //mysqli_query returns bool, if the query has been made succesfully notify the front end
    } else {
      //else throw error because user already exists
      $error = "username exists! please try another username";
    }
  }
}
?>

<div class="container">
  <div class="form-container">

    <form method="POST" action="">
      <h2>Create your Account</h2>

      <?php if ($error): ?>
        <p style="color:red">
          <?php echo $error; ?>
        </p>
      <?php endif; ?>

      <label for="username">Username:</label>
      <input value="<?php echo $username ?? ''; ?>" placeholder="Enter your username" type="text" name="username"
        required><br /><br />

      <label for="email">Email:</label>
      <input value="<?php echo $email ?? ''; ?>" placeholder="Enter your email" type="email" name="email"
        required><br /><br />

      <label for="password">Password:</label>
      <input placeholder="Enter your password" type="password" name="password" required><br /><br />

      <label for="confirm_password">Confirm Password:</label>
      <input placeholder="Confirm your password" type="password" name="confirm_password" required><br /><br />

      <input type="submit" value="Register">
    </form>
  </div>
</div>

<?php include "partials/footer.php"; ?>

<?php
mysqli_close($conn);
?>