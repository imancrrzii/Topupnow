<?php
ob_start();
include('templates_admin/header.php');
include('templates_admin/sidebar.php'); 
?>
<?php
class ChangePassword {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function updatePassword($id, $currentPassword, $newPassword, $confirmPassword) {
        $currentPassword = md5($currentPassword);
        $newPassword = md5($newPassword);
        $confirmPassword = md5($confirmPassword);
        $sql = "SELECT * FROM administrator WHERE id=$id AND password='$currentPassword'";
        $res = mysqli_query($this->conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                if ($newPassword == $confirmPassword) {
                    $sql2 = "UPDATE administrator SET password='$newPassword' WHERE id=$id ";
                    $res2 = mysqli_query($this->conn, $sql2);
                    if ($res2 == TRUE) {
                        $_SESSION['changePwd'] = '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        <i class="fas fa-user mr-2"></i>Password berhasil diubah!<button type="button" class="close"
                        data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        header('location:' . base_url . 'administrator/admin/manageAdmin.php');
                    }
                } else{
                    $_SESSION['pwd_not_match'] = '<div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                    <i class="fas fa-user mr-2"></i>Password baru dan konfirmasi password harus sama!<button type="button" class="close"
                    data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    header('location:' . base_url . 'administrator/admin/changePassword.php');
                }
            } else {
                $_SESSION['status'] = '<div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                <i class="fas fa-user mr-2"></i>Password baru dan konfirmasi password harus sama!<button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                header('location:' . base_url . 'administrator/admin/manageAdmin.php');
            }
        }
    }
}

if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $changePassword = new ChangePassword($conn);
    $changePassword->updatePassword($id, $_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmPassword']);
}

?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ubah Kata Sandi</h1>
        </div>
        <div class="col-md-12">
            <?php
            if (isset($_SESSION['pwd_not_match'])) {
                echo $_SESSION['pwd_not_match'];
                unset($_SESSION['pwd_not_match']);
            }
            ?>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="" class="col-md-12" method="POST">
                <div class="row">
                        <div class="col-md-12">
                    <div class="alert alert-warning md-3" role="alert">
                        <i class="fas fa-file mr-2"></i>
                        Fill in Your Information
                    </div>
                    <div class="form-group">
                        <label>Password Saat Ini</label>
                        <input type="password" class="form-control" name="currentPassword"
                            placeholder="Current Password" required>
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control" name="newPassword" placeholder="New Password"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password baru</label>
                        <input type="password" class="form-control" name="confirmPassword"
                            placeholder="Confirm Password" required>
                    </div>
                    <button class="btn btn-success" type="submit" name="submit"
                        onclick="return confirm('Apakah anda yakin untuk memesan ini?')"><i
                            class="fas fa-save mr-2"></i>Change password</button>
                    <button class="btn btn-danger" type="reset"><i class="fas fa-trash mr-2"></i>Reset</button>
                </form>
            </div>
        </div>
    </section>
