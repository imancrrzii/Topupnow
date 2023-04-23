<?php
include('templates/header.php');
include('templates/sidebar.php');
?>

<?php

class AdminDashboard
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getContactCount()
    {
        $sql = "SELECT * FROM kontak";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);
        return $count;
    }
    public function getAdminCount()
    {
        $sql = "SELECT * FROM administrator";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);
        return $count;
    }
    public function getCategoriesCount()
    {
        $sql = "SELECT * FROM kategori";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);
        return $count;
    }

    public function getFoodsCount()
    {
        $sql = "SELECT * FROM item";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);
        return $count;
    }

    public function getOrdersCount()
    {
        $sql = "SELECT * FROM pesanan";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);
        return $count;
    }

    public function getTotalRevenue()
    {
        $sql = "SELECT SUM(total_price) AS total FROM pesanan WHERE status='DELIVERED'";
        $res = mysqli_query($this->conn, $sql);
        $rows = mysqli_fetch_assoc($res);
        $total_revenue = $rows['total'];
        return $total_revenue;
    }

    public function showDashboard()
    {
        ?>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>
                <div class="row">

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <a href="<?php echo base_url; ?>administrator/manageAdmin.php">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-light text-black">
                                    <i class="fas fa-user-cog text-dark"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Admin</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $this->getAdminCount() ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <a href="<?php echo base_url; ?>administrator/manageCategory.php">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="far fa-list-alt"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Kategori</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $this->getCategoriesCount() ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <a href="<?php echo base_url; ?>administrator/manageFood.php">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Item</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $this->getFoodsCount() ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <a href="<?php echo base_url; ?>administrator/manageOrder.php">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Pesanan</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $this->getOrdersCount(); ?>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <a href="<?php echo base_url; ?>administrator/manageOrder.php">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Pendapatan</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $this->getTotalRevenue() ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <a href="<?php echo base_url; ?>administrator/manageContact.php">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-info">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Pesan</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $this->getContactCount() ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </a>
                </div>
            </section>
        </div>
        <?php
    }
}

?>
<?php
$dashboard = new AdminDashboard($conn);
$dashboard->showDashboard();
?>

<?php include('templates/footer.php') ?>