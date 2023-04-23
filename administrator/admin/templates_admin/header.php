<?php

session_start();

$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}
// either new or old, it should live at most for another hour
$_SESSION['discard_after'] = $now + 3600;
include('../../config/database.php');
$base_url = new BaseUrl();
define('base_url', $base_url->getBaseUrl());

$db = new Database();
$conn = $db->getConnection();



if (!isset($_SESSION['user'])) {
    //redirect to login page
    $_SESSION['no_login'] = "Please login to access admin panel";
    echo $_SESSION['no_login'];
    //redirect to login page
    header('location:' . base_url . 'administrator/login.php');
} else {

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Administrator TopupNow</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/modules/summernote/summernote-bs4.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/css/components.css">
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
</head>

