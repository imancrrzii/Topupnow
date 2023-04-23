<?php
include('templates/header.php');
?>

<?php
class SearchResult
{
    private $conn;
    private $keyword;

    public function __construct($conn, $keyword)
    {
        $this->conn = $conn;
        $this->keyword = mysqli_real_escape_string($conn, $keyword);
    }

    public function displayResults()
    {
        $sql = "SELECT * FROM kategori WHERE title LIKE '%{$this->keyword}%'";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($rows = mysqli_fetch_assoc($res)) {
                $id = $rows['id'];
                $title = $rows['title'];
                $image_name = $rows['image_name'];
                ?>
                <a href="<?= base_url . 'categoryItem.php?id=' . $id; ?>">
                    <div class="box" data-aos="zoom-in">
                        <?php if ($image_name == ''): ?>
                            <img src="<?= base_url . 'img.png'; ?>" alt="">
                        <?php else: ?>
                            <img src="<?= base_url . 'assets/img/category/' . $image_name; ?>" alt="">
                        <?php endif; ?>
                        <div class="info">
                            <p><?= $title; ?></p>
                        </div>
                    </div>
                </a>
                <?php
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            <i class="fas fa-times mr-2"></i>Kategori Tidak Ditemukan!<button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
    }

    public function displayHome()
    {
        ?>
        <div id="category" class="container" data-aos="fade-up">
            <div class="heading text-center">
                <h2>Hasil pencarian untuk <span>"<?= $this->keyword; ?>"</span></h2>
            </div>
            <div class="box-container" data-aos-delay="300" data-aos-duration="1000">
                <?php $this->displayResults(); ?>
            </div>
        </div>
        <?php
    }
}
?>

<?php
$keyword = $_POST['search'] ?? '';
$view = new SearchResult($conn, $keyword);
$view->displayHome();
?>

<?php
include('templates/footer.php');
?>