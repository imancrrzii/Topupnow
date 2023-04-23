<?php
ob_start();
include('templates_kontak/header.php');
include('templates_kontak/sidebar.php');
?>
<?php

class ManageContact
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getContacts()
    {
        $sql = "SELECT * FROM kontak";
        if (isset($_GET['search'])) {
            $searchTerm = mysqli_real_escape_string($this->conn, $_GET['search']);
            $sql .= " WHERE name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%' OR subject LIKE '%$searchTerm%' or message LIKE '%$searchTerm%'";
        }
        $res = mysqli_query($this->conn, $sql);

        return $res;
    }
    public function getContactLimit($start, $limit)
    {
        if (isset($_GET['search'])) {
            $searchTerm = mysqli_real_escape_string($this->conn, $_GET['search']);
            $sql = "SELECT * FROM kontak WHERE name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%' OR subject LIKE '%$searchTerm%' or message LIKE '%$searchTerm%' ORDER BY id DESC LIMIT $start, $limit";
        } else {
            $sql = "SELECT * FROM kontak ORDER BY id DESC LIMIT $start, $limit";
        }

        $result = mysqli_query($this->conn, $sql);
        return $result;
    }
}

?>

<link rel="stylesheet" type="text/css" href="css/yourStyles.css?<?= time(); ?>" />
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Kontak Kami</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-statistics">
                    <div class="card-body">
                    <div class="datatable-wrapper table-responsive">
                        <a href="<?= base_url; ?>administrator/export_pdf_contact.php"><button class="btn btn-danger"><i
                                    class="fas fa-file-pdf mr-2"></i>Export to
                                PDF</button></a>
                        <a href="<?= base_url; ?>administrator/export_excel_contact.php"><button
                                class="btn btn-success"><i class="fas fa-file-excel mr-2"></i>Export to
                                Excel</button></a>
                        <div class="col-md-12">
                            <?php
                            if (isset($_SESSION['add'])) {
                                echo $_SESSION['add'];
                                unset($_SESSION['add']);
                            }
                            if (isset($_SESSION['delete'])) {
                                echo $_SESSION['delete'];
                                unset($_SESSION['delete']);
                            }
                            if (isset($_SESSION['update'])) {
                                echo $_SESSION['update'];
                                unset($_SESSION['update']);
                            }
                            if (isset($_SESSION['status'])) {
                                echo $_SESSION['status'];
                                unset($_SESSION['status']);
                            }
                            ?>
                        </div>
                        <form class="form-inline my-3">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                                name="search">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                        </form>

                        <table id="datatable" class="display compact table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <?php
                            $manageContact = new manageContact($conn);
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $limit = 10;
                            $start = ($page - 1) * $limit;
                            $res = $manageContact->getContactLimit($start, $limit);

                            if ($res == TRUE) {
                                $count = mysqli_num_rows($res);
                                if ($count > 0) {
                                    $sn = 10 * ($page - 1) + 1;
                                    while ($rows = mysqli_fetch_assoc($res)) {
                                        $id = $rows['id'];
                                        $name = $rows['name'];
                                        $email = $rows['email'];
                                        $subject = $rows['subject'];
                                        $message = $rows['message'];
                                        ?>

                                        <tr>
                                            <td>
                                                <?= $sn ?>
                                            </td>
                                            <td>
                                                <?= $name ?>
                                            </td>
                                            <td>
                                                <?= $email ?>
                                            </td>
                                            <td>
                                                <?= $subject ?>
                                            </td>
                                            <td>
                                                <?= $message ?>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="<?= base_url; ?>administrator/kontak/detailContact.php?id=<?= $id; ?>"><button
                                                            class="btn btn-primary mr-1"><i class="fas fa-eye"></i></button></a>
                                                    <a href="<?= base_url; ?>administrator/kontak/deleteContact.php?id=<?= $id; ?>"><button
                                                            class="btn btn-danger"
                                                            onclick="return confirm('Apakah anda yakin untuk menghapus ini?')"><i
                                                                class="fas fa-trash"></i></button></a>
                                                </div>
                                            </td>

                                        </tr>
                                        <?php
                                        $sn++;
                                    }
                                } else {
                                    ?>
                                    <tr class="text-center">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="fas fa-trash mr-3"></i>Data tidak tersedia!<button type="button"
                                                class="close" data-dismiss="alert" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>;
                                        </div>
                                    </tr>
                                    <?php
                                }
                            }
                            $total_records = mysqli_num_rows($manageContact->getContacts());
                            $total_pages = ceil($total_records / $limit);
                            $previous_page = $page - 1;
                            $next_page = $page + 1;
                            ?>
                        </table>


                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <?php if ($previous_page > 0) { ?>
                                    <li class="page-item"><a class="page-link"
                                            href="?page=<?= $previous_page ?>">Previous</a></li>
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
<?php include('templates_kontak/footer.php') ?>