<?php

$conn = mysqli_connect('localhost', 'root', '', 'login_app');

if (!$conn) {
  echo "Not connected" . mysqli_error($conn);
}

function check_query($conn, $result)
{
  if (!$result) {
    return "Error" . mysqli_error($conn);
  }
  return true;
}
