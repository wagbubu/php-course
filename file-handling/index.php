<?php
ini_set("display_errors", 1);
$file_name = "data.txt";
$file = fopen($file_name, "a+");

if ($file) {
  fwrite($file, " HATDOOOOOG");
  rewind($file);
  $content = fread($file, filesize($file_name));
  fclose($file);
  echo $content;
} else {
  echo "something went wrong!";
}
