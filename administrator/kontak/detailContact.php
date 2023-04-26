<?php
ob_start();
include('templates_kontak/header.php');
include('templates_kontak/sidebar.php'); ?>
<?php

class ContactDetail
{
    private $id;
    private $name;
    private $email;
    private $subject;
    private $message;
    private $conn;

    public function __construct($id, $conn)
    {
        $this->id = $id;
        $this->conn = $conn;
    }

    public function getData()
    {
        $sql = "SELECT * FROM kontak WHERE id=$this->id";
        $res = mysqli_query($this->conn, $sql);

        if ($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $rows = mysqli_fetch_assoc($res);
                $this->name = $rows['name'];
                $this->email = $rows['email'];
                $this->subject = $rows['subject'];
                $this->message = $rows['message'];
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
            <h1>Detail Masukkan</h1>
        </div>

        <div class="card">
            <div class="card-body">

                <table class="table">
                    <tr>
                        <td>Name</td>
                        <td>
                            <?php echo $this->name ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <?php echo $this->email ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td>
                            <?php echo $this->subject ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>
                            <?php echo $this->message ?>
                        </td>
                    </tr>
                </table>
                <a href="<?php echo base_url ?>administrator/kontak/manageContact.php" class="btn btn-primary"><i
                        class="fas fa-undo-alt mr-1"></i>Kembali</a>
            </div>
        </div>
</div>
</div>
<?php
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $transaction_detail = new ContactDetail($id, $conn);
    $transaction_detail->getData();
    $transaction_detail->view();
} else {
    header('location:' . base_url . 'administrator/kontak/manageContact.php');
}

?>
<?php include('templates_kontak/footer.php') ?>