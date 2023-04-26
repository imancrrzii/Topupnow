<?php

session_start();
$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['discard_after'] = $now + 3600;
include('../../config/database.php');
$base_url = new BaseUrl();
define('base_url', $base_url->getBaseUrl());

$db = new Database();
$conn = $db->getConnection();

if (!isset($_SESSION['user'])) {
    $_SESSION['no_login'] = "Please login to access admin panel";
    echo $_SESSION['no_login'];
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
  <link rel="shortcut icon" href="<?= base_url ?>assets/prepaid.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="<?php echo base_url?>assets/assets_stisla/modules/summernote/summernote-bs4.css">
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

