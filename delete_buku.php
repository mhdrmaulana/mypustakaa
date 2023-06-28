<?php
include 'koneksi.php';
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Mendapatkan data dari request
if (isset($_POST['kode'])) {
    $kode = $_POST['kode'];

    // Query SQL untuk menghapus data buku berdasarkan kode
    $sql = "DELETE FROM buku WHERE kode='$kode'";

    if ($conn->query($sql) === TRUE) {
        $response = [
            'status' => 'success',
            'message' => 'Data buku berhasil dihapus.'
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
        'message' => 'Kode buku tidak ditemukan dalam permintaan.'
    ];
}

echo json_encode($response);
?>