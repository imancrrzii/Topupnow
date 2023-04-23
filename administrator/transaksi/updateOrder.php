<?php
ob_start();
include('templates_transaksi/header.php');
include('templates_transaksi/sidebar.php'); ?>
<!-- main section starts -->

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit data item</h1>
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
        if (isset($_GET['id'])) {
            //get the id of the admin selected
            $id = $_GET['id'];

            //create sql suery
            $sql = "SELECT * FROM pesanan WHERE id=$id";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //check whether the query is executed or not
            if ($res == true) {
                //check if data is available or not
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    //get the details
                    $rows = mysqli_fetch_assoc($res);
                    $item = $rows['item'];
                    $price = $rows['price'];
                    $total_price = $rows['total_price'];
                    $status = $rows['status'];
                    $customer_id_game = $rows['customer_id_game'];
                    $customer_name = $rows['customer_name'];
                    $customer_contact = $rows['customer_contact'];
                    $customer_email = $rows['customer_email'];
                    $customer_pay = $rows['customer_pay'];

                }
            } else {
                //redirect to managAdmin page
                header('location:' . base_url . 'administrator/transaksi/manageOrder.php');
            }
        } else {
            header('location:' . base_url . 'administrator/transaksi/manageOrder.php');
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
                                <label>Item</label>
                                <input type="text" class="form-control" value="<?php echo $item; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" class="form-control" value="<?php echo $price; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Pendapatan</label>
                                <input type="text" class="form-control" name="total_price"
                                    value="<?php echo $total_price; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Customer</label>
                                <input type="text" class="form-control" name="customer_name"
                                    value="<?php echo $customer_name; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option <?php if ($status == "Ordered") {
                                        echo "selected";
                                    }
                                    echo $status ?>  value="Ordered">Ordered</option>
                                    <option <?php if ($status == "Delivered") {
                                        echo "selected";
                                    }
                                    echo $status ?>  value="Delivered">Delivered</option>
                                    <option <?php if ($status == "Cancelled") {
                                        echo "selected";
                                    }
                                    echo $status ?> value="Cancelled">Cancelled</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Id Customer</label>
                                <input type="text" class="form-control" name="customer_id_game"
                                    value="<?php echo $customer_id_game; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Kontak Customer</label>
                                <input type="text" class="form-control" name="customer_contact"
                                    value="<?php echo $customer_contact; ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label>Email Customer</label>
                                <input type="text" class="form-control" name="customer_email"
                                    value="<?php echo $customer_email; ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label>Metode Pembayaran</label>
                                <input type="text" class="form-control" name="customer_pay"
                                    value="<?php echo $customer_pay; ?>" readonly>
                            </div>


                            <button name="submit" type="submit" data-toggle="modal"
                                data-target="#editModalTransaksi-<?= $id ?>" class="btn btn-success"><i
                                    class="fas fa-trash"></i>Update Transaction</button>


                </form>
            </div>

        </div>
    </section>
</div>


<!-- main section ends -->


<?php

//check if submit buttton is clicked or not
if (isset($_POST['submit'])) {
    //update the details
    $total_price = $_POST['total_price'];
    $status = $_POST['status'];
    $customer_id_game = $_POST['customer_id_game'];
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_pay = $_POST['customer_pay'];


    //create sql query to update admin
    $sql2 = "UPDATE pesanan
        SET total_price='$total_price',
            status='$status',
            customer_id_game='$customer_id_game',
            customer_name='$customer_name',
            customer_contact='$customer_contact',
            customer_pay='$customer_pay',
            customer_email='$customer_email'
        WHERE id='$id'
        ";
    //execue the query

    $res2 = mysqli_query($conn, $sql2);
    if ($res2 == TRUE) {
        //Query executed and order updated
        $_SESSION['update'] = '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <i class="fas fa-trash mr-3"></i>Data berhasil diubah!<button type="button" class="close"
            data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        //redirect to manageAdminpage
        header('location:' . base_url . 'administrator/transaksi/manageOrder.php');
    } else {
        //Failed to update order
        $_SESSION['update'] = '<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <i class="fas fa-trash mr-3"></i>Data gagal diubah!<button type="button" class="close"
            data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        header('location:' . base_url . 'administrator/transaksi/updateOrder.php');

    }
}
?>
<div class="modal fade z-3" id="editModalTransaksi-<?= $id ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Transaksi</h5>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin mengupdate transaksi
                <?= $customer_name ?>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="<?= base_url; ?>administrator/transaksi/updateOrder.php?id=<?= $id ?>" type="button"
                    class="btn btn-danger">Edit</a>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-backdrop.show {
        display: none !important;
    }
</style>

<?php include('templates_transaksi/footer.php') ?>