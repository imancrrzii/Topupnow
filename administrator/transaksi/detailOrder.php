<?php
ob_start();
include('templates_transaksi/header.php');
include('templates_transaksi/sidebar.php'); ?>
<?php

class TransactionDetail
{
    private $id;
    private $item;
    private $price;
    private $total_price;
    private $status;

    private $customer_id_game;
    private $customer_name;
    private $customer_contact;
    private $customer_email;
    private $customer_pay;
    private $conn;


    public function __construct($id, $conn)
    {
        $this->id = $id;
        $this->conn = $conn;
    }

    public function getData()
    {
        $sql = "SELECT * FROM pesanan WHERE id=$this->id";
        $res = mysqli_query($this->conn, $sql);

        if ($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //get the details
                $rows = mysqli_fetch_assoc($res);
                $this->item = $rows['item'];
                $this->price = $rows['price'];
                $this->total_price = $rows['total_price'];
                $this->status = $rows['status'];
                $this->customer_id_game = $rows['customer_id_game'];
                $this->customer_name = $rows['customer_name'];
                $this->customer_contact = $rows['customer_contact'];
                $this->customer_email = $rows['customer_email'];
                $this->customer_pay = $rows['customer_pay'];
            }
        } else {
            header('location:' . base_url . 'administrator/transaksi/manageOrder.php');
        }
    }

    public function view()
    {
        ?>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Detail Transaction</h1>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Item</td>
                                <td>
                                    <?php echo $this->item ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>
                                    <?php echo $this->price ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Price</td>
                                <td>
                                    <?php echo $this->total_price ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <?php
                                    if ($this->status == "Ordered") {
                                        echo "<span class='badge badge-warning'><i class='fas fa-user-clock mr-2'></i>$this->status </span>";
                                    } else if ($this->status == "Delivered") {
                                        echo "<span class='badge badge-success'><i class='fas fa-truck mr-2'></i>$this->status </span>";
                                    } else {
                                        echo "<span class='badge badge-danger'><i class='fas fa-truck'></i>$this->status </span>";
                                    }
                                    ?>
                                </td>
                            <tr>
                                <td>Customer Id</td>
                                <td>
                                    <?php echo $this->customer_id_game ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Customer Name</td>
                                <td>
                                    <?php echo $this->customer_name ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Customer Contact</td>
                                <td>
                                    <?php echo $this->customer_contact ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Pay Method</td>
                                <td>
                                    <?php echo $this->customer_pay ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Customer Email</td>
                                <td>
                                    <?php echo $this->customer_email ?>
                                </td>
                            </tr>
                            </tr>
                        </table>
                        <a href="<?php echo base_url ?>administrator/transaksi/manageOrder.php" class="btn btn-primary ml-4"><i
                                class="fas fa-undo-alt mr-1"></i>Back</a>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $transaction_detail = new TransactionDetail($id, $conn);
    $transaction_detail->getData();
    $transaction_detail->view();
} else {
    header('location:' . base_url . 'administrator/transaksi/manageOrder.php');
}

?>