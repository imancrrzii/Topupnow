<?php
session_start();
include('../../config/database.php');
$base_url = new BaseUrl();
define('base_url', $base_url->getBaseUrl());

$db = new Database();
$conn = $db->getConnection();
//get the id & image name of category to be deleted
class Kategori {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function deleteCategory($id) {
        $sql = "DELETE FROM kategori WHERE id='$id'";
        $res = mysqli_query($this->conn, $sql);
        if ($res == TRUE) {
            $_SESSION['delete'] = '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                <i class="fas fa-trash mr-3"></i>Data berhasil dihapus!<button type="button" class="close"
                    data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        } else {
            $_SESSION['delete'] = '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <i class="fas fa-trash mr-3"></i>Data gagal dihapus!<button type="button" class="close"
                    data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        }
        header('location:' . base_url . 'administrator/kategori/manageCategory.php');
    }
}

// Instantiate the Admin class and pass the database connection as an argument
$kategori = new Kategori($conn);

// Call the deleteAdmin function passing the id from $_GET as an argument
$id = $_GET['id'];
$kategori->deleteCategory($id);
?>