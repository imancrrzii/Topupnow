<?php
ob_start();
include('templates_kategori/header.php');
include('templates_kategori/sidebar.php');

?>


<?php
//buat class AddAdmin
class AddCategory
{
    //buat properti
    private $conn;

    //buat konstruktor
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //buat method untuk menambahkan data administrator
    public function addCategory($title, $image_name, $featured, $active)
    {
        $sql = "INSERT INTO kategori SET
                title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
        ";
        $res = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $res;
    }
}
?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Kategori</h1>
        </div>
        <div class="col-md-12">

            <?php
            if (isset($_SESSION['add'])) { //add session message
                echo $_SESSION['add']; //display session message
                unset($_SESSION['add']); //removing the session
            }
            if (isset($_SESSION['upload'])) { //add session message
                echo $_SESSION['upload']; //display session message
                unset($_SESSION['upload']); //removing the session
            }
            ?>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="" class="col-md-12" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning md-3" role="alert">
                                <i class="fas fa-file mr-2"></i>
                                Fill in Your Information
                            </div>

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>

                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" name="image" class="form-control mb-2">
                            </div>

                            <div class="form-group">
                                <label>Featured</label>
                                <select name="featured" class="form-control">
                                    <option value="">Pilih Featured</option>
                                    <option value="YES">Yes</option>
                                    <option value="NO">No</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Active Category</label>
                                <select name="active" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="YES">Yes</option>
                                    <option value="NO">No</option>
                                </select>
                            </div>


                            <button class="btn btn-success" type="submit" name="submit"
                                onclick="return confirm('Apakah anda yakin untuk memesan ini?')"><i
                                    class="fas fa-save mr-2"></i>Simpan</button>
                            <button class="btn btn-danger" type="reset"><i class="fas fa-trash mr-2"></i>Reset</button>
                </form>

            </div>

    </section>
    <?php
    //buat instance dari class AddAdmin
    $addCategory = new AddCategory($conn);

    if (isset($_POST['submit'])) {

        $title = $_POST['title'];
        if (isset($_POST['featured'])) {
            $featured = $_POST['featured'];
        } else {
            $featured = 'NO';
        }
        if (isset($_POST['active'])) {
            $active = $_POST['active'];
        } else {
            $active = 'NO';
        }
        // print_r($_FILES["image"]); //to display the array
    
        // die();  //break the code
    
        if (isset($_FILES['image']['name'])) {
            //upload the image
            //to upload image we need image name, src path and destination path
            $image_name = $_FILES['image']['name'];

            if ($image_name != '') {
                //auto-rename the image
                //get the extension of image
                $ext = end(explode('.', $image_name));

                //rename the image
                $image_name = "Food_category_" . time() . '.' . $ext; //to rename the file 
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = '../../assets/img/category/' . $image_name;

                //upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                //check whether the image is uploaded or not ; if not uploaded stop the process and redirect with error message
                if ($upload == FALSE) {
                    $_SESSION['upload'] = "<span>Failed to upload the image!</span>";
                    header("location:" . base_url . "administrator/kategori/addCategory.php");

                    //stop the process
                    die();
                }
            }
        } else {
            //do not upload image and set image name value as blank
            $image_name = '';
        }

        //panggil method addAdministrator untuk menambahkan data administrator
        $res = $addCategory->addCategory($title, $image_name, $featured, $active);

        if ($res == TRUE) {

            $_SESSION['add'] = '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            <i class="fas fa-user mr-2"></i>Data berhasil ditambahkan!<button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            header('location:' . base_url . 'administrator/kategori/manageCategory.php');
        } else {
            $_SESSION['add'] = '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            <i class="fas fa-user mr-2"></i>Data gagal ditambahkan!<button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            header('location:' . base_url . 'administrator/kategori/addCategory.php');
        }
    }
    ?>