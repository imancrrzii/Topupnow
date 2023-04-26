<?php
ob_start();
include('templates_item/header.php');
include('templates_item/sidebar.php');

?>

<?php
class AddItem
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
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
        $res = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
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
            if (isset($_SESSION['addItem'])) { 
                echo $_SESSION['addItem']; 
                unset($_SESSION['addItem']); 
            }
            if (isset($_SESSION['upload'])) { 
                echo $_SESSION['upload']; 
                unset($_SESSION['upload']); 
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
                                <input type="file" name="image" id="image" class="form-control mb-2">
                            </div>
                            <div class="form-group">
                                <label>Active Category</label>
                                <select name="category" class="form-control">
                                    <option value="">Pilih Category</option>
                                    <?php
                                    $sql = "SELECT * FROM kategori WHERE active='YES'";
                                    $res = mysqli_query($conn, $sql);
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
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
                            <div class="d-flex justify-content-end">
                            <button class="btn btn-danger mr-2" type="reset"><i class="fas fa-trash mr-2"></i>Reset</button>
                            <button class="btn btn-success" type="submit" name="submit"
                                onclick="return confirm('Apakah anda yakin untuk memesan ini?')"><i
                                    class="fas fa-save mr-2"></i>Simpan</button>
                            
                            </div>
                </form>
            </div>
    </section>
    <?php
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

        if (isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];
            if ($image_name != '') {

                $temp = explode('.', $image_name);
                $ext = end($temp);
                $image_name = "Item_" . time() . '.' . $ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = '../../assets/img/item/' . $image_name;
                $upload = move_uploaded_file($source_path, $destination_path);
                if ($upload == FALSE) {
                    $_SESSION['upload'] = "<span>Failed to upload the image!</span>";
                    header("location:" . base_url . "administrator/item/addItem.php");
                    die();
                }
            }
        } else {
            $image_name = '';
        }
        $res = $addItem->addItems($title, $description, $price, $image_name, $category, $featured, $active);

        if ($res == TRUE) {
            $_SESSION['addItem'] = '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            <i class="fas fa-user mr-2"></i>Data berhasil ditambahkan!<button type="button" class="close"
                            data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            header('location:' . base_url . 'administrator/item/manageItem.php');
            exit;
        } else {
            $_SESSION['addItem'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-user mr-2"></i>Data gagal ditambahkan!<button type="button" class="close"
                            data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            header('location:' . base_url . 'administrator/item/addItem.php');
            exit;
        }
    }
    ?>
    <?php include('templates_item/footer.php') ?>