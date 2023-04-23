<?php
include('templates/header.php');
?>

<?php
class ContactForm
{

    private $name;
    private $email;
    private $subject;
    private $message;

    function __construct($name, $email, $subject, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function insertMessage($conn)
    {
        $sql = "SELECT * FROM kontak WHERE email = '$this->email' AND message = '$this->message'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            echo '<script>alert("Pesan telah terkirim!!")</script>';
            echo ("<script>location.href = '" . base_url . "';</script>");
        } else {
            //insert new message
            $sql2 = "INSERT INTO kontak SET
                name = '$this->name',
                email = '$this->email',
                subject = '$this->subject',
                message = '$this->message'
                ";
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == TRUE) {
                //message placed
                echo '<script>
                $(document).ready(function(){
                    $("#contactModal").modal("show");
                });
            </script>';
            } else {
                //failed to place message
                echo '<script>alert("Failed to place message!! Try again later")</script>';
                echo ("<script>location.href = '" . base_url . "';</script>");
            }
        }
    }
}

?>
<section id="contacts" class="contacts">
    <div class="container">

        <div class="section-title" data-aos="fade-up">
            <h2>Contact Us</h2>
        </div>

        <div class="row">
            <div class="col-lg-6 d-flex" data-aos="zoom-in">
                <div class="info-box" data-aos="zoom-in">
                    <i class="fas fa-map-marked-alt"></i>
                    <h3>Location</h3>
                    <p>Jl. Raya Palembang - Prabumulih Km. 32 Indralaya, OI, Sumatera Selatan</p>
                </div>
            </div>

            <div class="col-lg-3 d-flex" data-aos="zoom-in">
                <div class="info-box" data-aos="zoom-in">
                    <i class="fas fa-envelope"></i>
                    <h3>Email</h3>
                    <p>Group5@gmail.com<br>Kelompok5@gmail.com</p>
                </div>
            </div>

            <div class="col-lg-3 d-flex" data-aos="zoom-in">
                <div class="info-box " data-aos="zoom-in">
                    <i class="fas fa-phone-volume"></i>
                    <h3>Call</h3>
                    <p>+62 813 6878 8772<br>+62 899 6549 060</p>
                </div>
            </div>
            <div class="col-lg-12" data-aos="fade-up">
                <form action="" method="post" role="form" class="php-email-form">
                    <div class="row">
                        <div class="col-lg-6 form-group" data-aos="zoom-in">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                required>
                        </div>
                        <div class="col-lg-6 form-group" data-aos="zoom-in">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                                required>
                        </div>
                    </div>
                    <div class="form-group" data-aos="zoom-in">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                            required>
                    </div>
                    <div class="form-group" data-aos="zoom-in">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message"
                            required></textarea>
                    </div>
                    <div class="my-3" data-aos="zoom-in">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    <div class="text-center" data-aos="zoom-in"><button type="submit" name="submit"
                            class="btn btn-primary"><i class="fas fa-paper-plane mr-2"></i>Send Message</button></div>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $subject = $_POST['subject'];
                    $message = $_POST['message'];

                    $contactForm = new ContactForm($name, $email, $subject, $message);
                    $contactForm->insertMessage($conn);
                }
                ?>
            </div>
        </div>
        <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="contactModalLabel">Pesan telah terkirim</h4>
                    </div>
                    <div class="modal-body">
                        <h5>Terimakasih telah memberikan masukkan di TopupNow. Silahkan tunggu hingga admin membaca
                            pesan anda!
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