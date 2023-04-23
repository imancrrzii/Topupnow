<?php
include('templates/header.php');
?>

<?php
class Transaksi
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getOrderDetails($item_id)
    {
        $sql = "SELECT * FROM item WHERE id=$item_id";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $rows = mysqli_fetch_assoc($res);
            $title = $rows['title'];
            $price = $rows['price'];
            $image_name = $rows['image_name'];
            return array($title, $price, $image_name);
        } else {
            return false;
        }
    }

    function placeOrder($title, $price, $status, $customer_id_game, $customer_name, $customer_contact, $customer_email, $customer_pay, $total_price, $newName)
    {
        $sql2 = "INSERT INTO pesanan SET
        item = '$title',
        price = '$price',
        status = '$status',
        customer_id_game = '$customer_id_game',
        customer_name = '$customer_name',
        customer_contact = '$customer_contact',
        customer_email = '$customer_email',
        customer_pay = '$customer_pay',
        total_price = '$total_price',
        pay_img = '$newName'
        ";
        $res2 = mysqli_query($this->conn, $sql2);
        if ($res2 == TRUE) {
            echo '<script>
                $(document).ready(function(){
                    $("#orderModal").modal("show");
                });
            </script>';
        } else {
            echo '<script>alert("Failed to place transaksi!! Try again later")</script>';
            echo ("<script>location.href = '" . base_url . "';</script>");
        }
    }
}

$transaksi = new Transaksi($conn);
if (isset($_GET['id'])) {
    $item_id = $_GET['id'];
    $orderDetails = $transaksi->getOrderDetails($item_id);
    if ($orderDetails) {
        list($title, $price, $image_name) = $orderDetails;
    } else {
        echo '<script>alert("Dish not found")</script>';
        header('location:' . base_url);
    }
} else {
    header('location:' . base_url);
    echo '<script>alert("Please select the dish first!!")</script>';
}

if (isset($_POST['submit'])) {
    $customer_id_game = $_POST['customer_id_game'];
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_pay = $_POST['customer_pay'];
    $status = "Ordered";

    if ($customer_pay == 'TELKOMSEL') {
        $tax_rate = 1.1;
    } else if ($customer_pay == 'DANA' || $customer_pay == 'GOPAY') {
        $tax_rate = 0.96;
    } else if ($customer_pay == 'BCA' || $customer_pay == 'BRI') {
        $tax_rate = 1;
    } else {
        $tax_rate = 0;
    }
    $total_price = $price * $tax_rate;
    $total_price = mysqli_real_escape_string($conn, $total_price);

    $filename = $_FILES['pay_img']['name'];
    $tmp_name = $_FILES['pay_img']['tmp_name'];

    $type1 = explode('.', $filename);
    $type2 = $type1[1];
    $newName = 'item' . time() . '.' . $type2;
    $allow_type = array('jpg', 'jpeg', 'png', 'Png', 'Jpg', 'Jpeg');
    $upload_dir = 'assets/img/bukti_pembayaran/';

    if (!in_array($type2, $allow_type)) {
        echo '<script>alert("format tidak diizinkan")</script>';
    } else {
        move_uploaded_file($tmp_name, $upload_dir . $newName);
    }
    $transaksi->placeOrder($title, $price, $status, $customer_id_game, $customer_name, $customer_contact, $customer_email, $customer_pay, $total_price, $newName);
}

?>
<section id="transaksi" class="container">
    <div class="heading text-center">
    </div>

    <div class="row">
        <div class="col-lg-5 mb-5">
            <div class="card" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="1000">
                <h3 class="card-header bg-light"><i class="bi bi-info-circle-fill mr-2"></i>How to Top-up</h3>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="selected"></div>
                        <div class="outputText">
                            <input type="text" name="selected-item" value="<?php echo $title ?>" readonly>
                        </div>
                        <div class="outputText mb-3">
                            <input type="text" name="price" value="<?php echo $price ?>" readonly>
                        </div>
                        <h5>1. Masukkan data diri kamu pada form pengisian</h5>
                        <h5>2. Pilih Metode Pembayaran</h5>
                        <h5>3. Lakukan Pembayaran pada Metode yang dpilih</h5>
                        <h5>4. Screenshot Bukti Pembayaran</h5>
                        <h5>5. Tunggu Administrator menyelesaikan pembelianmu</h5>
                        <h5>6. Produk akan ditambahkan ke akun permainanmu</h5>
                        <h3 class="card-header bg-light mb-3 mt-3">Informasi Pembayaran</h3>
                        <h4>Lakukan Pembayaranmu via:</h4>
                        <h5>1. Telkomsel - 081368798772</h5>
                        <h5>2. DANA - 081368798772</h5>
                        <h5>3. BCA - 1608211555</h5>
                        <h5>4. BRI - 152221447</h5>
                        <h5>5. GOPAY - 081368798772</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-7 mb-5">
            <div class="card" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="1000">
                <h3 class="card-header bg-light">Masukkan Data anda!</h3>
                <div class="card-body">
                    <div class="alert alert-secondary alert-dismissible fade show mt-2" role="alert">
                        <i class="bi bi-1-circle-fill mr-2"></i>Masukkan User ID
                    </div>
                    <label>ID Game</label>
                    <div class="inputBox">
                        <input type="text" class="form-control" name="customer_id_game"
                            placeholder="Masukkan ID Game Anda" required>
                    </div>
                    <div class="alert alert-secondary alert-dismissible fade show mt-2" role="alert">
                        <i class="bi bi-2-circle-fill mr-2"></i>Masukkan Email
                    </div>

                    <label>Nama</label>
                    <div class="inputBox">
                        <input type="text" class="form-control" name="customer_name" placeholder="Masukkan Nama Anda"
                            required>
                    </div>
                    <label>Telepon</label>
                    <div class="inputBox">
                        <input type="text" class="form-control" name="customer_contact"
                            placeholder="Masukkan Nomor Telepon Anda" required>
                    </div>
                    <label>E-Mail</label>
                    <div class="inputBox">
                        <input type="email" class="form-control" name="customer_email"
                            placeholder="Masukkan E-mail Anda" required>
                    </div>

                    <div class="alert alert-secondary alert-dismissible fade show mt-2" role="alert">
                        <i class="bi bi-3-circle-fill mr-2"></i>Pilih Pembayaran
                    </div>
                    <div class="section over-hide z-bigger">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <input class="checkbox-customer_pay" value="TELKOMSEL" type="radio"
                                        name="customer_pay" id="tool-1" checked>
                                    <label class="for-checkbox-customer_pay" for="tool-1">
                                        <i class='bx bx-credit-card-alt mr-2'></i>TELKOMSEL
                                        <?= number_format($price * 1.1) ?>
                                    </label>
                                    <input class="checkbox-customer_pay" type="radio" value="DANA" name="customer_pay"
                                        id="tool-2">
                                    <label class="for-checkbox-customer_pay" for="tool-2">
                                        <i class='bx bx-credit-card-alt mr-2'></i>DANA
                                        <?= number_format($price * 0.96) ?>
                                    </label>
                                    <input class="checkbox-customer_pay" type="radio" value="BCA" name="customer_pay"
                                        id="tool-3">
                                    <label class="for-checkbox-customer_pay" for="tool-3">
                                        <i class='bx bxs-credit-card mr-2'></i>BCA
                                        <?= number_format($price * 1) ?>
                                    </label>
                                    <input class="checkbox-customer_pay" type="radio" value="BRI" name="customer_pay"
                                        id="tool-4">
                                    <label class="for-checkbox-customer_pay" for="tool-4">
                                        <i class='bx bxs-credit-card mr-2'></i>BRI
                                        <?= number_format($price * 1) ?>
                                    </label>
                                    <input class="checkbox-customer_pay" type="radio" value="GOPAY" name="customer_pay"
                                        id="tool-5">
                                    <label class="for-checkbox-customer_pay" for="tool-5">
                                        <i class='bx bxs-credit-card mr-2'></i>GOPAY
                                        <?= number_format($price * 0.96) ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-secondary alert-dismissible fade show mt-2" role="alert">
                        <i class="bi bi-4-circle-fill mr-2"></i>Upload Bukti Pembayaran
                    </div>
                    <div class="inputImg mt-2 mb-2">
                        <input type="file" class="form-control" name="pay_img" required>
                    </div>

                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                        <label class="form-check-label ml-1" for="flexCheckDefault">
                            Ya, Saya yakin untuk melakukan pembelian! </label>
                    </div>

                    <button class="btn btn-success mt-3" id="btnKirim" type="submit" name="submit"><i
                            class="fas fa-paper-plane mr-2"></i>Kirim Pesanan</button>
                    </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen-md-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="orderModalLabel">Pesanan Ditambahkan</h4>
                    </div>
                    <div class="modal-body">
                        <h5>Terimakasih telah memesan di TopupNow. Silahkan tunggu hingga admin menyelesaikan pesanan
                        </h5>
                    </div>
                    <div class="modal-footer">
                        <button onclick="location.href='<?php echo base_url ?>'" type="button" class="btn btn-primary"
                            data-bs-dismiss="modal"><i class="fas fa-undo-alt mr-2"></i>Kembali ke halaman
                            utama</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include('templates/footer.php');
?>