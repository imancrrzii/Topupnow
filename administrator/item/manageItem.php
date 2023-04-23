<?php
include('templates_item/header.php');
include('templates_item/sidebar.php');

?>
<?php

class ManageItem
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getItem()
    {
        $sql = "SELECT * FROM item";
        if (isset($_GET['search'])) {
            $searchTerm = mysqli_real_escape_string($this->conn, $_GET['search']);
            $sql .= " WHERE title LIKE '%$searchTerm%'";
        }
        $res = mysqli_query($this->conn, $sql);

        return $res;
    }
    public function getItemLimit($start, $limit)
    {
        if (isset($_GET['search'])) {
            $searchTerm = mysqli_real_escape_string($this->conn, $_GET['search']);
            $sql = "SELECT * FROM item WHERE title LIKE '%$searchTerm%' ORDER BY id ASC LIMIT $start, $limit";
        } else {
            $sql = "SELECT * FROM item ORDER BY id ASC LIMIT $start, $limit";
        }

        $result = mysqli_query($this->conn, $sql);
        return $result;
    }
}

?>

<!-- main section starts -->

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Item</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-statistics">
                    <div class="card-body">
                    <div class="datatable-wrapper table-responsive">
        <!-- button to add admin -->
        <a href="<?php echo base_url; ?>administrator/item/addItem.php" class="btn btn-primary"><i
                class="fas fa-plus mr-2"></i>Tambah Item</a>
        <a href="<?php echo base_url; ?>administrator/export_pdf.php" class="btn btn-danger"><i
                class="fas fa-file-pdf mr-2"></i>Export to PDF</a>

        <div class="col-md-12">
            <?php
            if (isset($_SESSION['addItem'])) { //add session message
                echo $_SESSION['addItem']; //display session message
                unset($_SESSION['addItem']); //removing the session
            }
            if (isset($_SESSION['delete'])) { //add session 
                echo $_SESSION['delete']; //display session messsage
                unset($_SESSION['delete']);
            }
            if (isset($_SESSION['update_item'])) { //add session 
                echo $_SESSION['update_item']; //display session messsage
                unset($_SESSION['update_item']); //removing the session
            }
            if (isset($_SESSION['no_food'])) { //add session 
                echo $_SESSION['no_food']; //display session messsage
                unset($_SESSION['no_food']); //removing the session
            }
            if (isset($_SESSION['remove'])) { //add session 
                echo $_SESSION['remove']; //display session messsage
                unset($_SESSION['remove']); //removing the session
            }
            ?>
        </div>


        <form class="form-inline my-3">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
        <table id="datatable" class="display compact table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php
            $manageItem = new manageItem($conn);
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $limit = 10;
            $start = ($page - 1) * $limit;
            $res = $manageItem->getItemLimit($start, $limit);
            //create a query 
            //execute the query
            //check whether the query is executed or not
            if ($res == TRUE) {
                //query is executed
                //count no of rows to check whether there is data in database or not
                $count = mysqli_num_rows($res);

                //check if there is data in database
                if ($count > 0) {
                    //there is data in database
            
                    //for unique id
                    $sn = 10 * ($page - 1) + 1;
                    while ($rows = mysqli_fetch_assoc($res)) {

                        //using while loop to get all data from database
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $description = $rows['description'];
                        $price = $rows['price'];
                        $image_name = $rows['image_name'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];

                        ?>
                        <tr>
                            <td>
                                <?php echo $sn++ ?>
                            </td>
                            <td>
                                <?php echo $title ?>
                            </td>
                            <td>
                                <?php echo $description ?>
                            </td>
                            <td>
                                <?php echo $price ?>
                            </td>
                            <td>
                                <?php
                                //check if image name is available or not
                                if ($image_name != '') {
                                    //display the image
                                    ?>
                                    <img src="<?php echo base_url; ?>assets/img/item/<?php echo $image_name; ?>" width="100px">
                                    <?php
                                } else {
                                    echo "<h4><span>Image not added</span></h4>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $featured ?>
                            </td>
                            <td>
                                <?php echo $active ?>
                            </td>
                            <td>
                                <div class="d-flex">

                                    <a href="<?php echo base_url; ?>administrator/item/updateItem.php?id=<?php echo $id; ?>"><button
                                            class="btn btn-warning mr-1"><i class="fas fa-edit mr-2"></i>Edit</button></a>
                                    <button data-toggle="modal" data-target="#hapusModalItem-<?= $id ?>" class="btn btn-danger"><i
                                            class="fas fa-trash mr-1"></i>Hapus</button>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade z-3" id="hapusModalItem-<?= $id ?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Admin</h5>

                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus item
                                        <?= $title ?>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <a href="<?= base_url; ?>administrator/item/deleteItem.php?id=<?= $id ?>" type="button"
                                            class="btn btn-danger">Hapus</a>
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
                    }
                } else {
                    ?>
                    <tr class="text-center">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-trash mr-2"></i>Item not Available!<button type="button" class="close"
                                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    </tr>
                    <?php
                }
            }
            $total_records = mysqli_num_rows($manageItem->getItem());
            $total_pages = ceil($total_records / $limit);
            $previous_page = $page - 1;
            $next_page = $page + 1;
            ?>
        </table>


        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php if ($previous_page > 0) { ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $previous_page ?>">Previous</a></li>
                <?php } ?>

                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        $active = "active";
                    } else {
                        $active = "";
                    }
                    ?>
                    <li class="page-item <?= $active ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php } ?>

                <?php if ($next_page <= $total_pages) { ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $next_page ?>">Next</a></li>
                <?php } ?>
            </ul>
        </nav>
    </section>
</div>


<!-- main section ends -->

<?php include('templates_item/footer.php') ?>