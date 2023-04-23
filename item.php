<?php
include('templates/header.php');
?>

<?php
class Item
{
    private $conn;
    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getCategoryTitle($category_id)
    {
        $sql = "SELECT * FROM kategori WHERE id = $category_id";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $rows = mysqli_fetch_assoc($res);
            $title = $rows['title'];
            return $title;
        } else {
            return false;
        }
    }

    public function displayItems($category_id)
    {
        $sql = "SELECT * FROM item WHERE active='YES' AND category_id = $category_id";
        $res = mysqli_query($this->conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($rows = mysqli_fetch_assoc($res)) {
                $id_item = $rows['id'];
                $title_item = $rows['title'];
                $image_name_item = $rows['image_name'];
                $description = $rows['description'];
                echo "<div class='card' data-aos='zoom-in'>";
                if ($image_name_item == '') {
                    echo "<img src='" . base_url . "img.png' alt=''>";
                } else {
                    echo "<img src='" . base_url . "assets/img/item/$image_name_item' alt=''>";
                }
                echo "<h2>$title_item</h2>";
                echo "<p>$description</p>";
                echo "<a href='" . base_url . "transaksi.php?id=$id_item'><button>Topup Now</button></a>";
                echo "</div>";
            }
        } else {
            echo '<div class="alert alert-danger md-3 mt-5 alert-tidak" data-aos-delay="300" data-aos-duration="1000" role="alert" >
            <i class="fa-solid fa-times mr-2"></i>
            Item tidak tersedia
        </div>';
        }
    }

}
?>

<?php
$item = new Item($conn);
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $title = $item->getCategoryTitle($category_id);
    if (!$title) {
        header('location:' . base_url);
    }
} else {
    header('location:' . base_url);
}
?>

<div id="items" class="container-fluid">
    <div class="heading text-center" data-aos="fade-up">
        <h1>Item dari kategori
            <?php echo $title ?>
        </h1>
    </div>
    <div class="card-container text-center">
        <?php $item->displayItems($category_id); ?>
    </div>
</div>

<?php
include('templates/footer.php');
?>