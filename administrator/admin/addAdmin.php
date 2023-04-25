<?php
ob_start();
include('templates_admin/header.php');
include('templates_admin/sidebar.php');
?>
<?php
class AddAdmin
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addAdministrator($full_name, $username, $password)
    {
        $sql = "INSERT INTO administrator SET
                full_name='$full_name',
                username='$username',
                password='$password'";
        $res = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $res;
    }
}
?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Administrator</h1>
        </div>
        <div class="col-md-12">
            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
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
                                <label>
                                    Nama Lengkap
                                </label>
                                <input type="text" class="form-control" name="full_name" placeholder="Full name"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    required>
                            </div>
                            <button class="btn btn-success" type="submit" name="submit"
                                onclick="return confirm('Apakah anda yakin untuk memesan ini?')"><i
                                    class="fas fa-save mr-2"></i>Simpan</button>
                            <button class="btn btn-danger" type="reset"><i class="fas fa-trash mr-2"></i>Reset</button>
                </form>
            </div>
    </section>
    <?php
    $addAdmin = new AddAdmin($conn);
    if (isset($_POST['submit'])) {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $res = $addAdmin->addAdministrator($full_name, $username, $password);
        if ($res == TRUE) {
            $_SESSION['add'] = '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            <i class="fas fa-user mr-2"></i>Data berhasil ditambahkan!<button type="button" class="close"
                            data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            header('location:' . base_url . 'administrator/admin/manageAdmin.php');
            exit;
        } else {
            $_SESSION['add'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-user mr-2"></i>Data gagal ditambahkan!<button type="button" class="close"
                            data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            header('location:' . base_url . 'administrator/admin/addAdmin.php');
            exit;
        }
    }
    ?>