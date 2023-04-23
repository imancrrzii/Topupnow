<?php
include('config/database.php');

$url = new BaseUrl();
define('base_url', $url->getBaseUrl());

$db = new Database();
$conn = $db->getConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopupNow</title>
    <link href="<?= base_url ?>assets/logo.png" rel='shortcut icon'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Climate+Crisis&family=Golos+Text&family=Montserrat&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/812cea5233.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="<?= base_url ?>assets/logo.png">
</head>

<body onload="hide_loading">
    <header id="header">
        <nav>
            <ul>
                <li><a href="<?= base_url; ?>">
                        <h1>TopupNow</h1>
                    </a></li>
                <li><a href="<?= base_url; ?>">Beranda</a></li>
                <li><a href="<?= base_url; ?>about.php">Tentang</a></li>
                <li><a href="<?= base_url; ?>kategori.php">Kategori</a></li>
                <li><a href="<?= base_url; ?>contact.php">Kontak</a></li>
                <li>
                    <form action="<?= base_url; ?>search.php" method="POST" class="d-flex search" role="search">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                            name="search">
                        <button class="btn btn-primary my-2 my-sm-0" type="submit"><i
                                class="fas fa-search"></i></button>
                    </form>
                    </form>
                </li>
            </ul>
        </nav>
        <div class="fas fa-bars"></div>
        <a href="<?= base_url; ?>" class="logo"><img src="assets/logo.png" alt=""></a>
    </header>

    <div class="loading overlay">
        <div class="loadingio-spinner-eclipse-0y9k1hlvev2">
            <div class="ldio-vhc98ikw0d">
                <div></div>
            </div>
        </div>
    </div>