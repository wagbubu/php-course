<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // echo "<pre>";
  // var_dump($_FILES);
  // echo "</pre>";
  if (!file_exists("uploads/")) {
    mkdir("uploads", 0777, true);
  }
  foreach ($_FILES["files"]["name"] as $key => $file_name) {
    $file_tmp = $_FILES["files"]["tmp_name"][$key];
    $file_size = $_FILES["files"]["size"][$key];
    $file_error = $_FILES["files"]["error"][$key];
    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $target_file = "uploads/" . basename($file_name);

    if ($file_error === UPLOAD_ERR_OK) {
      if ($file_size > 5 * 1024 * 1024) {
        echo "file too large";
        echo "<br/>";
      } elseif (!in_array($file_type, ['jpg', 'jpeg', 'png', 'gif', 'pdf'])) {
        echo "ERROR file type $file_name is not allowed";
        echo "<br/>";
      } else {
        if (move_uploaded_file($file_tmp, $target_file)) {
          echo "File $file_name uploaded successfully";
          echo "<br/>";
        } else {
          echo "Error: there was an error uploading the image";
        }
      }
    }
    // echo "<pre>"; 
    // var_dump($file_type);
    // var_dump($file_tmp);
    // var_dump($file_error);
    // var_dump($file_size);
    // echo "</pre>";
  }
}
