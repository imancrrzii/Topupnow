<?php
include('templates/header.php');
?>

<?php
class Category
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function getFeaturedCategories()
    {
        $sql = "SELECT * FROM kategori WHERE featured='YES' AND active='YES' LIMIT 12";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($rows = mysqli_fetch_assoc($res)) {
                $id = $rows['id'];
                $title = $rows['title'];
                $image_name = $rows['image_name'];
                ?>
                <a href="<?= base_url; ?>item.php?id=<?= $id ?>">
                    <div class="box" data-aos="zoom-in">
                        <?php
                        if ($image_name == '') {
                            ?>
                            <img src="<?= base_url; ?>img.png" alt="">
                            <?php
                        } else {
                            ?>
                            <img src="<?= base_url; ?>assets/img/category/<?= $image_name ?>" alt="">
                            <?php
                        }
                        ?>
                        <div class="info" data-aos="fade-up">
                            <p>
                                <?= $title; ?>
                            </p>
                        </div>
                    </div>
                </a>
                <?php
            }
        } else {
            echo "<h1><span>Category not added</span></h1>";
        }
    }

    public function getRecentCategories()
    {
        $sql = "SELECT * FROM kategori WHERE featured='YES' AND active='YES' ORDER BY id DESC LIMIT 12";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($rows = mysqli_fetch_assoc($res)) {
                $id = $rows['id'];
                $title = $rows['title'];
                $image_name = $rows['image_name'];
                ?>
                <a href="<?= base_url; ?>item.php?id=<?= $id ?>">
                    <div class="box" data-aos="zoom-in">
                        <?php
                        if ($image_name == '') {
                            ?>
                            <img src="<?= base_url; ?>img.png" alt="">
                            <?php
                        } else {
                            ?>
                            <img src="<?= base_url; ?>assets/img/category/<?= $image_name ?>" alt="">
                            <?php
                        }
                        ?>
                        <div class="info" data-aos="fade-up">
                            <p>
                                <?= $title; ?>
                            </p>
                        </div>
                    </div>
                </a>
                <?php
            }
        } else {
            echo "<h1><span>Category not added</span></h1>";
        }
    }
    public function displayHome()
    {
        ?>
        <section id="home" class="container-fluid">
            <div class="container">
                <div class="row min-vh-100 align-items-center">

                    <div class="col-md-6 text-md-left content" data-aos="fade-down" data-aos-easing="linear"
                        data-aos-duration="1500">
                        <h1>Cara tercepat dan termudah untuk membeli kredit game</h1>
                        <p>Situs web top-up terbesar dan tepercaya untuk game dan hiburan online di dunia.</p>
                        <a href="<?= base_url; ?>kategori.php"><button type="button" class="btn btn-primary">Coba Sekarang</button></a>
                    </div>
                    <div class="col-md-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="500"
                        data-aos-duration="1000">
                        <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                    </div>
                    <?php
                    if (isset($_SESSION['pesanan'])) {
                        echo $_SESSION['pesanan'];
                        unset($_SESSION['pesanan']);
                    }
                    ?>
                </div>
            </div>
        </section>
        <div id="categories" class="container-fluid">
            <div class="heading text-center" data-aos="fade-up">
                <h1>POPULER</h1>
                <p>LEBIH HEMAT PAKAI TOPUPNOW!</p>
            </div>
            <div class="box-container">
                <?php $this->getFeaturedCategories(); ?>
            </div>
            <div class="view_all" data-aos="fade-up">
                <a href="<?= base_url ?>kategori.php"><button type="button" class="btn btn-primary">Show all</button></a>
            </div>
        </div>

        <div id="recent" class="container-fluid">
            <div class="heading text-center" data-aos="fade-up">
                <h1>TERBARU</h1>
                <p>LEBIH HEMAT PAKAI TOPUPNOW!</p>
            </div>
            <div class="box-container">
                <?php $this->getRecentCategories(); ?>
            </div>
            <div class="view_all" data-aos="fade-up">
                <a href="<?= base_url ?>kategori.php"><button type="button" class="btn btn-primary">Show all</button></a>
            </div>
        </div>
        <?php
    }
}
?>
<?php
$Category = new Category($conn);
$Category->displayHome();
?>

<?php
include('templates/footer.php');
?>