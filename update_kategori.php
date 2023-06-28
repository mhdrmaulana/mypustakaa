<?php
include 'koneksi.php';
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Mendapatkan data dari request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
// Memeriksa apakah elemen-elemen yang dibutuhkan tersedia dalam array $_POST
    if (isset($_POST['kode'], $_POST['kategori'])) {
        $kode = $_POST['kode'];
        $kategori = $_POST['kategori'];

// Query SQL untuk mengupdate data kategori berdasarkan kode
        $sql = "UPDATE kategori SET kategori='$kategori' WHERE kode='$kode'";

        if ($conn->query($sql) === TRUE) {
            $response = [
                'status' => 'success',
                'message' => 'Data kategori berhasil diperbarui.'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $conn->error
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Metode request yang tidak valid.'
        ];
    }
}

echo json_encode($response);
?>
