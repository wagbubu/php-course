<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  header("Location: admin.php");
  die('user is logged in');
}
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = 'raven';
  $password = 'secret';

  $input_username = $_POST['username'];
  $input_password = $_POST['password'];

  if ($input_username === $username && $input_password === $password) {
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $input_username;

    header("Location: admin.php");
  } else {
    $message = 'Invalid username or password';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>

<body>
  <h2>Login Page</h2>
  <?php if ($message): ?>
    <p style="color:red;"><?= $message ?></p>
  <?php endif; ?>
  <form method="POST">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" />
    <br />
    <br />
    <label for="password">Password</label>
    <input type="password" id="password" name="password" />
    <br />
    <br />
    <button type="submit">submit</button>
  </form>
</body>

</html>