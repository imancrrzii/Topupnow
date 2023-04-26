<?php
ob_start();
include('templates_item/header.php');
include('templates_item/sidebar.php'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Item</h1>
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
            $sql = "SELECT * FROM item WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $rows = mysqli_fetch_assoc($res);
                $title = $rows['title'];
                $description = $rows['description'];
                $price = $rows['price'];
                $current_image_name = $rows['image_name'];
                $current_category = $rows['category_id'];
                $featured = $rows['featured'];
                $active = $rows['active'];
            } else {

                $_SESSION['no_food'] = '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <i class="fas fa-trash mr-3"></i>Item not found!<button type="button" class="close"
                    data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                header("location:" . base_url . "administrator/item/manageItem.php");
            }
        } else {
            header("location:" . base_url . "administrator/item/manageItem.php");
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
                                <label>Description</label>
                                <textarea name="description" class="form-control " cols="30" rows="10"
                                    value="<?php echo $description; ?>"><?php echo $description; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" value="<?php echo $price; ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Gambar Saat ini</label>
                                <?php
                                if ($current_image_name != '') {
                                    ?>
                                            <img src="<?php echo base_url; ?>assets/img/item/<?php echo $current_image_name; ?>"
                                                width="100px">
                                            <?php
                                } else {
                                    echo "<h4><span>Image not added</span></h4>";
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label>Image baru</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Active Category</label>
                                    <select name="category" class="form-control" required="">
                                        <?php
                                        $sql2 = "SELECT * FROM kategori WHERE active='YES'";
                                        $res2 = mysqli_query($conn, $sql2);
                                        $count2 = mysqli_num_rows($res2);
                                        if ($count2 > 0) {
                                            while ($rows2 = mysqli_fetch_assoc($res2)) {
                                                $category_title = $rows2['title'];
                                                $category_id = $rows2['id'];
                                                ?>
                                                                <option <?php if ($current_category == $category_id) {
                                                                    echo "selected='selected'";
                                                                }
                                                                echo $active ?>
                                                                    value="<?php echo $category_id; ?>">
                                                                        <?php echo $category_title; ?>
                                                                </option>
                                                                <?php
                                            }
                                        } else {
                                            ?>
                                                    <option value="0">
                                                        <h3>Category not available</h3>
                                                    </option>
                                                    <?php
                                        } ?>
                                    </select>
                                </div>
                            <div class="form-group">
                                <label>Featured</label>
                                <select name="featured" class="form-control" required="">
                                <option <?php if ($featured == "YES") {
                                    echo "selected='selected'";
                                }
                                echo $featured ?> value="YES">YES</option>
                                <option <?php if ($featured == "NO") {
                                    echo "selected";
                                }
                                echo $featured ?> value="NO">NO</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Active</label>
                                <select name="active" class="form-control" required="">
                                <option <?php if ($active == "YES") {
                                    echo "selected='selected'";
                                }
                                echo $active ?> value="YES">YES</option>
                                <option <?php if ($active == "NO") {
                                    echo "selected";
                                }
                                echo $active ?> value="NO">NO</option>
                                </select>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image_name" value="<?php echo $current_image_name; ?>">
                            <div class="d-flex justify-content-end">
                            <button class="btn btn-danger mr-2" type="reset"><i class="fas fa-trash mr-2"></i>Reset</button>
                            <button class="btn btn-success" type="submit" name="submit"
                                onclick="return confirm('Apakah anda yakin untuk memesan ini?')"><i
                                    class="fas fa-save mr-2"></i>Update Item</button>
                            
                            </div>
                </form>
            </div>
    </section>
    <?php
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $current_image_name = $_POST['current_image_name'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

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
                    $_SESSION['upload'] = '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-trash mr-3"></i>Failed to upload the image<button type="button" class="close"
                        data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    header("location:" . base_url . "administrator/item/addItem.php");
                    die();
                }
                if ($current_image_name != '') {
                    $path = '../../assets/img/item/' . $current_image_name;
                    $remove = unlink($path);
                    if ($remove == FALSE) {
                        $_SESSION['remove'] = '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-trash mr-3"></i>Failed to remove<button type="button" class="close"
                            data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        header('location:' . base_url . 'administrator/item/manageItem.php');
                        die();
                    }
                }
            } else {
                $image_name = $current_image_name;
            }
        } else {
            $image_name = $current_image_name;
        }
        $sql3 = "UPDATE item SET 
        title='$title',
        description='$description',
        price='$price',
        image_name='$image_name',
        category_id='$category',
        featured='$featured',
        active='$active'
    WHERE id=$id";
        $res3 = mysqli_query($conn, $sql3);
        if ($res3 == TRUE) {
            $_SESSION['update_item'] = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-trash mr-3"></i>Data berhasil diubah!<button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            header('location:' . base_url . 'administrator/item/manageItem.php');
        } else {
            $_SESSION['update_item'] = '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-trash mr-3"></i>Data gagal diubah!<button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            header('location:' . base_url . 'administrator/item/updateItem.php');
        }
    } 
    ?>
    <?php include('templates_item/footer.php'); ?>