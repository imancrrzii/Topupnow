<?php
include('../../config/database.php');
require('../fpdf184/fpdf.php');

$base_url = new BaseUrl();
define('base_url', $base_url->getBaseUrl());

$db = new Database();
$conn = $db->getConnection();

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetMargins(30, 20, 30);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);

$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(0, 10, 'Data Administrator', 0, 1, 'C');

$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(10, 7, '', 0, 1);
$pdf->Cell(15, 6, 'No', 1, 0);
$pdf->Cell(30, 6, 'ID Admin', 1, 0);
$pdf->Cell(50, 6, 'Nama', 1, 0);
$pdf->Cell(50, 6, 'Username', 1, 0);

$pdf->SetFont('Times', '', 11);
$no = 1;
$query = "SELECT * FROM administrator";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $pdf->Ln();
    $pdf->Cell(15, 6, $no++, 1, 0);
    $pdf->Cell(30, 6, $row['id'], 1, 0);
    $pdf->Cell(50, 6, $row['full_name'], 1, 0);
    $pdf->Cell(50, 6, $row['username'], 1, 0);
}
$pdf->Output();
?>