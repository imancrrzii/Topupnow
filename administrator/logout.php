<?php
session_start();
include('../config/connection.php');
$base_url = new BaseUrl();
define('base_url', $base_url->getBaseUrl());

$db = new Database();
$conn = $db->getConnection();

//end the session
session_destroy();

//redirect to login page
header('location:' . base_url . 'administrator/login.php');
?>