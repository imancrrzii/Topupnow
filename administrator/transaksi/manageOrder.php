<?php
include('templates_transaksi/header.php');
include('templates_transaksi/sidebar.php'); ?>

<?php
class ManageOrder
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getOrder()
    {
        $sql = "SELECT * FROM pesanan";
        if (isset($_GET['search'])) {
            $searchTerm = mysqli_real_escape_string($this->conn, $_GET['search']);
            $sql .= " WHERE item LIKE '%$searchTerm%'";
        }
        $res = mysqli_query($this->conn, $sql);

        return $res;
    }
    public function getOrderLimit($start, $limit)
    {
        if (isset($_GET['search'])) {
            $searchTerm = mysqli_real_escape_string($this->conn, $_GET['search']);
            $sql = "SELECT * FROM pesanan WHERE item LIKE '%$searchTerm%' ORDER BY id DESC LIMIT $start, $limit";
        } else {
            $sql = "SELECT * FROM pesanan ORDER BY id DESC LIMIT $start, $limit";
        }

        $result = mysqli_query($this->conn, $sql);
        return $result;
    }
}

?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Transaksi</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="datatable-wrapper table-responsive">
                            <div class="col-md-12">
                                <?php
                                if (isset($_SESSION['delete'])) {
                                    echo $_SESSION['delete']; 
                                    unset($_SESSION['delete']);
                                }
                                if (isset($_SESSION['update'])) { 
                                    echo $_SESSION['update']; 
                                    unset($_SESSION['update']); 
                                }
                                if (isset($_SESSION['remove'])) { 
                                    echo $_SESSION['remove']; 
                                    unset($_SESSION['remove']); 
                                }
                                ?>
                            </div>
                            <form class="form-inline my-3">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search"
                                    aria-label="Search" name="search">
                                <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                            </form>

                            <table id="datatable" class="display compact table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Item</th>
                                        <th>Harga</th>
                                        <th>Harga Total</th>
                                        <th>Status</th>
                                        <th>Id Permainan</th>
                                        <th>Nama</th>
                                        <th>Kontak</th>
                                        <th>Email</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Bukti Pembayaran</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <?php
                                $manageOrder = new manageOrder($conn);
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $limit = 5;
                                $start = ($page - 1) * $limit;
                                $res = $manageOrder->getOrderLimit($start, $limit);
                                if ($res == TRUE) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        $sn = 5 * ($page - 1) + 1;
                                        while ($rows = mysqli_fetch_assoc($res)) {
                                            $id = $rows['id'];
                                            $item = $rows['item'];
                                            $price = $rows['price'];
                                            $total_price = $rows['total_price'];
                                            $status = $rows['status'];
                                            $customer_id_game = $rows['customer_id_game'];
                                            $customer_name = $rows['customer_name'];
                                            $customer_contact = $rows['customer_contact'];
                                            $customer_email = $rows['customer_email'];
                                            $customer_pay = $rows['customer_pay'];
                                            $pay_img = $rows['pay_img'];
                                            ?>
                                <tr class="text-center">
                                    <td>
                                        <?php echo $sn ?>
                                    </td>
                                    <td>
                                        <?php echo $item ?>
                                    </td>
                                    <td>
                                        <?php echo $price ?>
                                    </td>
                                    <td>
                                        <?php echo $total_price ?>
                                    </td>
                                    <td>
                                        <?php
                                                    if ($status == "Ordered") {
                                                        echo "<span class='badge badge-warning'><i class='fas fa-user-clock me-2'></i>$status </span>";
                                                    } else if ($status == "Delivered") {
                                                        echo "<span class='badge badge-success'><i class='fas fa-truck me-2'></i>$status </span>";
                                                    } else {
                                                        echo "<span class='badge badge-danger'><i class='fas fa-truck'></i>$status </span>";
                                                    }
                                                    ?>
                                    </td>
                                    <td>
                                        <?php echo $customer_id_game ?>
                                    </td>
                                    <td>
                                        <?php echo $customer_name ?>
                                    </td>
                                    <td>
                                        <?php echo $customer_contact ?>
                                    </td>
                                    <td>
                                        <?php echo $customer_email ?>
                                    </td>
                                    <td>
                                        <?php echo $customer_pay ?>
                                    </td>

                                    <td>
                                        <?php
                                                    if ($pay_img != '') {
                                                        ?>
                                        <img src="<?php echo base_url; ?>assets/img/bukti_pembayaran/<?php echo $pay_img; ?>"
                                            width="100px">
                                        <?php
                                                    } else {
                                                        echo "<h4><span>Image not added</span></h4>";
                                                    }
                                                    ?>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="<?= base_url; ?>administrator/transaksi/detailOrder.php?id=<?= $id; ?>"><button
                                                    class="btn btn-primary mr-1"><i class="fas fa-eye"></i></button></a>
                                            <a href="<?= base_url; ?>administrator/transaksi/updateOrder.php?id=<?= $id; ?>"><button
                                                    class="btn btn-warning mr-1"><i class="fas fa-clipboard-check"></i></button></a>
                                            <?php if($pay_img != '') { ?>
                                            <a href="<?= base_url; ?>assets/img/bukti_pembayaran/<?= $pay_img ?>" download><button class="btn btn-success mr-1"><i class="fas fa-download"></i></button></a><?php } ?>
                                            <button data-toggle="modal" data-target="#hapusModalTransaksi-<?= $id ?>"
                                                class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade z-3" id="hapusModalTransaksi-<?= $id ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Transaksi</h5>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus transaksi
                                                <?= $item ?>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-dismiss="modal">Batal</button>
                                                <a href="<?= base_url; ?>administrator/transaksi/deleteOrder.php?id=<?= $id ?>"
                                                    type="button" class="btn btn-danger">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <style>
                                .modal-backdrop.show {
                                    display: none !important;
                                }
                                </style>
                                <?php
                                            $sn++;
                                        }
                                    } else {
                                        ?>
                                <?php
                                    }
                                }
                                $total_records = mysqli_num_rows($manageOrder->getOrder());
                                $total_pages = ceil($total_records / $limit);
                                $previous_page = $page - 1;
                                $next_page = $page + 1;
                                ?>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <?php if ($previous_page > 0) { ?>
                                    <li class="page-item"><a class="page-link"
                                            href="?page=<?= $previous_page ?>">Previous</a></li>
                                    <?php } ?>
                                    <?php
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == $page) {
                                            $active = "active";
                                        } else {
                                            $active = "";
                                        }
                                        ?>
                                    <li class="page-item <?= $active ?>"><a class="page-link"
                                            href="?page=<?= $i ?>"><?= $i ?></a></li>
                                    <?php } ?>
                                    <?php if ($next_page <= $total_pages) { ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?= $next_page ?>">Next</a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </nav>
    </section>
</div>
<div class="modal fade" id="hapusModalOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <a type="button" class="btn btn-success"
                    href="<?= base_url; ?>administrator/deleteOrder.php?id=<?= $id; ?>">Hapus</a>
            </div>
        </div>
    </div>
</div>
<?php include('templates_transaksi/footer.php') ?>