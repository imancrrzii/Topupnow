<?php
ob_start();
include('templates_admin/header.php');
include('templates_admin/sidebar.php'); ?>
<?php
class UpdateAdmin {
  private $id;
  private $conn;

  public function __construct($id, $conn) {
    $this->id = $id;
    $this->conn = $conn;
  }

  public function getAdminData() {
    $sql = "SELECT * FROM administrator WHERE id=$this->id";
    $res = mysqli_query($this->conn, $sql);
    if ($res == true) {
      $count = mysqli_num_rows($res);
      if ($count == 1) {
        $rows = mysqli_fetch_assoc($res);
        return $rows;
      }
    } else {
      header('location:' . base_url . 'administrator/admin/manageAdmin.php');
    }
  }
  public function updateAdminData($full_name, $username) {
    $sql = "UPDATE administrator 
            SET full_name='$full_name',
                username='$username'
            WHERE id='$this->id'";
    $res = mysqli_query($this->conn, $sql);
    if ($res == TRUE) {
      $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      <i class="fas fa-trash mr-3"></i>Data berhasil diubah!<button type="button" class="close"
          data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
      header('location:' . base_url . 'administrator/manageAdmin.php');
    } else {
      $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      <i class="fas fa-trash mr-3"></i>Data gagal diubah!<button type="button" class="close"
          data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
      header('location:' . base_url . 'administrator/updateAdmin.php');
    }
  }
}
$admin_id = $_GET['id'];
$updateAdmin = new UpdateAdmin($admin_id, $conn);
$adminData = $updateAdmin->getAdminData();

if (isset($_POST['submit'])) {
  $full_name = $_POST['full_name'];
  $username = $_POST['username'];
  $updateAdmin->updateAdminData($full_name, $username);
}

?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Data Administrator</h1>
    </div>
    <div class="col-md-12">
      <?php
      if (isset($_SESSION['update'])) {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
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
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" name="full_name" value="<?php echo $adminData['full_name']; ?>">
              </div>
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" value="<?php echo $adminData['username']; ?>">
              </div>
              <button class="btn btn-success" type="submit" name="submit" onclick="return confirm('Apakah anda yakin untuk memesan ini?')">
                <i class="fas fa-save mr-2"></i>Update Administrator</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>