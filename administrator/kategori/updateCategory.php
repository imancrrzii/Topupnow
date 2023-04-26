<?php
ob_start();
include('templates_kategori/header.php');
include('templates_kategori/sidebar.php'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Kategori</h1>
        </div>
        <div class="col-md-12">
            <?php
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            ?>
        </div>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM kategori WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $rows = mysqli_fetch_assoc($res);
                $title = $rows['title'];
                $current_image_name = $rows['image_name'];
                $featured = $rows['featured'];
                $active = $rows['active'];

            } else {
                $_SESSION['no_category'] = "<span>Category not found</span>";
                header("location:" . base_url . "administrator/kategori/manageCategory.php");
            }
        } else {
            header("location:" . base_url . "administrator/kategori/manageCategory.php");
        }
        ?>
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
                                <input type="text" class="form-control" name="title" value="<?php echo $title; ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Gambar Saat ini</label>
                                <?php
                                if ($current_image_name != '') {
                                    ?>
                                    <img src="<?php echo base_url; ?>assets/img/category/<?php echo $current_image_name; ?>"
                                        width="100px">
                                    <?php
                                } else {
                                    echo "<h4><span>Image not added</span></h4>";
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label>Image baru</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Featured</label>
                                <select name="featured" class="form-control" required="">
                                <option <?php if($featured == "YES") {
                                    echo "selected='selected'";
                                }echo $featured ?> value="YES">YES</option>
                                <option <?php if($featured == "NO") {
                                    echo "selected='selected'";
                                }echo $featured ?> value="NO">NO</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Active</label>
                                <select name="active" class="form-control" required""">
                                <option <?php if($active == "YES") {
                                    echo "selected='selected'";
                                }echo $active ?> value="YES">YES</option>
                                <option <?php if($active == "NO") {
                                    echo "selected='selected'";
                                }echo $active ?> value="NO">NO</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                            <button class="btn btn-danger mr-2" type="reset"><i class="fas fa-trash mr-2"></i>Reset</button>
                            <button class="btn btn-success" type="submit" name="submit"
                                onclick="return confirm('Apakah anda yakin untuk memesan ini?')"><i
                                    class="fas fa-save mr-2"></i>Update Administrator</button>
                            </div>
                </form>
            </div>
        </div>
    </section>
    <?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        if (isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];
            if ($image_name != '') {
                $temp = explode('.', $image_name);
                $ext = end($temp);
                $image_name = "Food_category_" . time() . '.' . $ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = '../../assets/img/category/' . $image_name;
                $upload = move_uploaded_file($source_path, $destination_path);
                if ($upload == FALSE) {
                    $_SESSION['upload'] = "<span>Failed to upload the image!</span>";
                    header("location:" . base_url . "administrator/kategori/addCategory.php");

                    die();
                }
                if ($current_image_name != '') {
                    $path = '../../assets/img/category/' . $current_image_name;
                    $remove = unlink($path);
                    if ($remove == FALSE) {
                        $_SESSION['remove'] = "<span>Failed to remove category image</span>";
                        header('location:' . base_url . 'administrator/kategori/manageCategory.php');
                        die();
                    }
                }
            } else {
                $image_name = $current_image_name;
            }
        } else {
            $image_name = $current_image_name;
        }
        $sql2 = "UPDATE kategori 
    SET title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        WHERE id='$id'";    
        $res2 = mysqli_query($conn, $sql2);
        if ($res2 == TRUE) {
            $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-trash mr-3"></i>Data berhasil diubah!<button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            header('location:' . base_url . 'administrator/kategori/manageCategory.php');
        } else {
            $_SESSION['update'] = '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-trash mr-3"></i>Data gagal diubah!<button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            header('location:' . base_url . 'administrator/kategori/updateCategory.php');
        }
    } ?>

    <?php include('templates_kategori/footer.php'); ?>