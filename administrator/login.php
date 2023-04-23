<?php
ob_start();
session_start();
unset($_SESSION["session"]);
include('../config/database.php');
$base_url = new BaseUrl();
define('base_url', $base_url->getBaseUrl());

$db = new Database();
$conn = $db->getConnection();
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <title>Administration TopupNow</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="<?= base_url ?>assets/prepaid.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url ?>assets/css/login/vendors.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url ?>/assets/css/login/style.css" />
    <link rel="stylesheet" href="<?= base_url ?>assets/assets_stisla/modules/fontawesome/css/all.min.css">
</head>

<body class="bg-white">
    <?php
    class LoginForm
    {
        private $conn;
        private string $username;
        private string $password;

        public function __construct($conn)
        {
            $this->conn = $conn;
        }
        public function displayForm()
        {
            ?>

            <div class="app">
                <div class="app-wrap">
                    <div class="app-contant">
                        <div class="bg-white">
                            <div class="container-fluid p-0">
                                <div class="row no-gutters">
                                    <div class="col-sm-6 col-lg-5 col-xxl-3  align-self-center order-2 order-sm-1">
                                        <div class="d-flex align-items-center h-100-vh">
                                            <div class="login p-50">
                                                <h1 class="mb-2">TopupNow</h1>
                                                <form method="POST" action="" class="mt-3 mt-sm-5">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Username</label>
                                                                <input id="username" type="text" class="form-control"
                                                                    autocomplete="off" name="username" tabindex="1" required
                                                                    autofocus>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <input id="password" type="password" class="form-control"
                                                                    name="password" tabindex="2" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <button type="submit" name="submit"
                                                                class="btn btn-primary text-uppercase"><i
                                                                    class="fas fa-sign-in-alt mr-2"></i>Login</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xxl-9 col-lg-7 bg-gradient o-hidden order-1 order-sm-2">
                                        <div class="row align-items-center h-100">
                                            <div class="col-7 mx-auto ">
                                                <img class="img-fluid" src="<?= base_url ?>assets/login.svg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        public function checkLogin()
        {
            if (isset($_POST['submit'])) {
                $this->username = $_POST['username'];
                $this->password = md5($_POST['password']);

                $sql = "SELECT * FROM administrator WHERE username='$this->username' AND password='$this->password'";

                $res = mysqli_query($this->conn, $sql);

                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    $_SESSION['login_status'] = '<div class="alert alert-success" role="alert">
                        <i class="fas fa-check mr-2"></i>
                        Login Successfully
                    </div>';
                    $_SESSION['user'] = $this->username;
                    header('location:' . base_url . 'administrator/');
                } else {
                    $_SESSION['login_status'] = "<span>Login Unsuccessful!! Username and password do not match</span>";
                    header('location:' . base_url . 'administrator/login.php');
                }
            }
        }
    }

    $form = new LoginForm($conn);

    $form->displayForm();
    $form->checkLogin();
    ?>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>