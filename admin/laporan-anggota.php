<?php
include "../conn.php";
require('../fpdf17/fpdf.php');
/**
 Judul  : Laporan PDF (portait):
 Level  : Menengah
 Author : PerpustakaanKU
 Blog   : www.PerpustakaanKU.com
 Web    : www.PerpustakaanKU.com
 Email  : sisteminformasi494@gmail.com
 
 Butuh jasa pembuatan website, aplikasi, pembuatan program TA dan Skripsi.? Hubungi Email ==>> sisteminformasi494@gmail.com
 
 **/
$pdf = new FPDF('P', 'mm', array(220, 297)); //L For Landscape / P For Portrait
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(80);
$pdf->Cell(30, 10, 'DATA ANGGOTA', 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(80);
$pdf->Cell(30, 10, 'Website PerpustakaanKU', 0, 0, 'C');
$pdf->Ln();

$result = mysqli_query($conn, "SELECT * FROM data_anggota ORDER BY id ASC") or die(mysqli_error($conn));

$Y_Fields_Name_position = 30;

//Gray color filling each Field Name box
if ($pdf !== null) {
    $pdf->SetFillColor(192, 192, 192); // Set the RGB color values for gray
} else {
    die("Objek PDF tidak diinisialisasi.");
}

//Fields Name position
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(25);
$pdf->Cell(55, 8, 'Nama', 1, 0, 'C', 1);
$pdf->SetX(80);
$pdf->Cell(15, 8, 'JK', 1, 0, 'C', 1);
$pdf->SetX(95);
$pdf->Cell(15, 8, 'Usia', 1, 0, 'C', 1);
$pdf->SetX(110);
$pdf->Cell(50, 8, 'Tempat Tanggal Lahir', 1, 0, 'C', 1);
$pdf->SetX(160);
$pdf->Cell(55, 8, 'Alamat', 1, 0, 'C', 1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 38;

//Now show the columns
$pdf->SetFont('Arial', '', 10);

while ($row = mysqli_fetch_array($result)) {
    $nama = $row["nama"];
    $jk = $row["jk"];
    $kelas = $row["kelas"];
    $ttl = $row["ttl"];
    $alamat = $row["alamat"];

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX(25);
    $pdf->MultiCell(55, 6, $nama, 1, 'L');

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX(80);
    $pdf->MultiCell(15, 6, $jk, 1, 'C');

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX(95);
    $pdf->MultiCell(15, 6, $kelas, 1, 'C');

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX(110);
    $pdf->MultiCell(50, 6, $ttl, 1, 'L');

    $pdf->SetY($Y_Table_Position);
    $pdf->SetX(160);
    $pdf->MultiCell(55, 6, $alamat, 1, 'C');

    $Y_Table_Position += 6; // Move to the next row
}

$pdf->Output();
?>