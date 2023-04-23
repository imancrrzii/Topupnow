<?php
ob_start();
include('templates_kategori/header.php');
include('templates_kategori/sidebar.php'); ?>
<!-- main section starts -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Administrator</h1>
        </div>
        <div class="col-md-12">

            <?php
            if (isset($_SESSION['update'])) { //add session message
                echo $_SESSION['update']; //display session message
                unset($_SESSION['update']); //removing the session
            }
            ?>
        </div>

        <?php
        //check whether id is set or not
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            //create sql query to get alll other details
            $sql = "SELECT * FROM kategori WHERE id=$id";

            //execute the query
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //get the data
                $rows = mysqli_fetch_assoc($res);
                $title = $rows['title'];
                $current_image_name = $rows['image_name'];
                $featured = $rows['featured'];
                $active = $rows['active'];

            } else {
                //data is not present
                //redirect to manageCategory page
                $_SESSION['no_category'] = "<span>Category not found</span>";
                header("location:" . base_url . "administrator/kategori/manageCategory.php");
            }

        } else {
            //redirect to manageCategory
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
                                //check if image name is available or not
                                if ($current_image_name != '') {
                                    //display the image
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
                            <button class="btn btn-success" type="submit" name="submit"
                                onclick="return confirm('Apakah anda yakin untuk memesan ini?')"><i
                                    class="fas fa-save mr-2"></i>Update Administrator</button>
                            <button class="btn btn-danger" type="reset"><i class="fas fa-trash mr-2"></i>Reset</button>
                </form>

            </div>
        </div>
    </section>
    <?php
    //check if submit buttton is clicked or not
    if (isset($_POST['submit'])) {
        //update the details
        $title = $_POST['title'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //print_r($_FILES["image"]); //to display the array
    
        //die();  //break the code
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
                if ($current_image_name != '') {
                    //remove the current image
                    $path = '../../assets/img/category/' . $current_image_name;
                    //remove the current image
                    $remove = unlink($path);
                    if ($remove == FALSE) {
                        //failed to remove image
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
        //create sql query to update admin
        $sql2 = "UPDATE kategori 
    SET title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        WHERE id='$id'";
        //execue the query
    
        $res2 = mysqli_query($conn, $sql2);
        if ($res2 == TRUE) {
            //Query executed and admin updated
            $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-trash mr-3"></i>Data berhasil diubah!<button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            //redirect to manageAdminpage
            header('location:' . base_url . 'administrator/kategori/manageCategory.php');
        } else {
            //Failed to update Admin
            $_SESSION['update'] = '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-trash mr-3"></i>Data gagal diubah!<button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            header('location:' . base_url . 'administrator/kategori/updateCategory.php');
        }
    } ?>

    <?php include('templates_kategori/footer.php'); ?>