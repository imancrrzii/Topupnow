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

    public function getCategories()
    {
        $sql = "SELECT * FROM kategori WHERE active='YES'";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($rows = mysqli_fetch_assoc($res)) {
                $id = $rows['id'];
                $title = $rows['title'];
                $image_name = $rows['image_name'];
                ?>
                <a href="<?php echo base_url; ?>item.php?id=<?php echo $id ?>">
                    <div class="box" data-aos="zoom-in">
                        <?php
                        if ($image_name == '') {
                            ?>
                            <img src="<?php echo base_url; ?>img.png" alt="">
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo base_url; ?>assets/img/category/<?php echo $image_name ?>" alt="">
                            <?php
                        }
                        ?>
                        <div class="info">
                            <p>
                                <?php echo $title; ?>
                            </p>
                        </div>
                    </div>
                </a>
                <?php
            }
        } else {
            echo "<div class='error'><h1>Category not added</h1></div>";
        }
    }
}
?>

<?php
$category = new Category($conn);
?>

<div id="category" class="container-fluid" data-aos="fade-up">

    <div class="heading text-center">
        <h1>Semua Kategori</h1>
</div>
    <div class="box-container" data-aos-delay="300" data-aos-duration="1000">
        <?php
        $category->getCategories();
        ?>
    </div>
</div>

<?php
include('templates/footer.php');
?>