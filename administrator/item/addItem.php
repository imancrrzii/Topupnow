<?php
ob_start();
include('../templates/header.php');
include('../templates/sidebar.php');

?>

<?php
//buat class AddAdmin
class AddItem
{
    //buat properti
    private $conn;

    //buat konstruktor
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //buat method untuk menambahkan data administrator
    public function addItems($title, $description, $price, $image_name, $category, $featured, $active)
    {
        $sql = "INSERT INTO item SET
                title='$title',
            description='$description',
            price='$price',
            image_name='$image_name',
            category_id='$category',
            featured='$featured',
            active='$active'
        ";
        $res = mysqli_query($this->conn, $sql) or die(mysqli_error());
        return $res;
    }
}
?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Item</h1>
        </div>
        <div class="col-md-12">

            <?php
            if (isset($_SESSION['addItem'])) { //add session message
                echo $_SESSION['addItem']; //display session message
                unset($_SESSION['addItem']); //removing the session
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
                                <input type="text" class="form-control" name="title" placeholder="Title" required>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control " cols="30" rows="10"
                                    placeholder="description"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" required>
                            </div>


                            <div class="form-group">
                                <label>Select Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Active Category</label>
                                <select name="category" class="form-control">
                                    <option value="">Pilih Category</option>

                                    <?php //php code to display categories from database
                                    
                                    //create sql query to get all active categories from database
                                    $sql = "SELECT * FROM kategori WHERE active='YES'";

                                    //Execute the query
                                    $res = mysqli_query($conn, $sql);

                                    //count no of rows to check whether there is data in database or not
                                    $count = mysqli_num_rows($res);

                                    //check if there is data in database
                                    if ($count > 0) {
                                        //there is data in database
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id = $rows['id'];
                                            $title = $rows['title'];

                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="1">
                                            <h3>item</h3>
                                        </option>
                                        <?php
                                    } ?>
                                </select>
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
    $addItem = new addItem($conn);

    if (isset($_POST['submit'])) {

        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

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
                $temp = explode('.', $image_name);
                $ext = end($temp);

                //rename the image
                $image_name = "Item_" . time() . '.' . $ext; //to rename the file 
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = '../../assets/img/item/' . $image_name;

                //upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                //check whether the image is uploaded or not ; if not uploaded stop the process and redirect with error message
                if ($upload == FALSE) {
                    $_SESSION['upload'] = "<span>Failed to upload the image!</span>";
                    header("location:" . base_url . "administrator/item/addItem.php");
                    //stop the process
                    die();
                }
            }
        } else {
            //do not upload image and set image name value as blank
            $image_name = '';
        }

        //panggil method addAdministrator untuk menambahkan data administrator
        $res = $addItem->addItems($title, $description, $price, $image_name, $category, $featured, $active);

        if ($res == TRUE) {

            $_SESSION['add'] = '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            <i class="fas fa-user mr-2"></i>Data berhasil ditambahkan!<button type="button" class="close"
                            data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            header('location:' . base_url . 'administrator/item/manageItem.php');
            exit;
        } else {

            $_SESSION['add'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-user mr-2"></i>Data gagal ditambahkan!<button type="button" class="close"
                            data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            header('location:' . base_url . 'administrator/item/addItem.php');
            exit;
        }
    }
    ?>