<?php
include 'koneksi.php';
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Mendapatkan data dari request
$kode = $_GET['kode'];

// Query SQL untuk mengambil data buku berdasarkan kode
$sql = "SELECT * FROM buku WHERE kode='$kode'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $buku = $result->fetch_assoc();
    $response = [
        'status' => 'success',
        'data' => $buku
    ];
} else {
    $response = [
        'status' => 'error',
        'message' => 'Data buku tidak ditemukan.'
    ];
}

echo json_encode($response);
?>
