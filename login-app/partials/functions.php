<?php

function is_user_logged_in()
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function redirect($location = "login.php")
{
    header("Location: $location");
    exit;
}
function setActiveCLass($pageName)
{
    $current_page = basename($_SERVER['PHP_SELF']);
    return ($current_page === $pageName) ? "active" : '';
}

function getPageClass()
{
    return basename($_SERVER['PHP_SELF'], ".php");
}

function user_exists($conn, $username)
{
    $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}


function full_month_date($date)
{
    return date("F j, Y", strtotime($date));
}








