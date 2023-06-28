<?php
include 'koneksi.php';
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Memeriksa apakah data telah dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Memeriksa apakah elemen-elemen yang dibutuhkan tersedia dalam array $_POST
    if (isset($_POST['kode'], $_POST['kode_kategori'], $_POST['judul'], $_POST['pengarang'], $_POST['penerbit'], $_POST['tahun'], $_POST['tanggal_input'], $_POST['harga'], $_POST['file_cover'])) {
        // Mendapatkan data dari request
        $kode = $_POST['kode'];
        $kode_kategori = $_POST['kode_kategori'];
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $tahun = $_POST['tahun'];
        $tanggal_input = $_POST['tanggal_input'];
        $harga = $_POST['harga'];
        $file_cover = $_POST['file_cover'];

        // Query SQL untuk memperbarui data buku berdasarkan kode
        $sql = "UPDATE buku SET kode_kategori='$kode_kategori', judul='$judul', pengarang='$pengarang', penerbit='$penerbit', tahun='$tahun', tanggal_input='$tanggal_input', harga='$harga', file_cover='$file_cover' WHERE kode='$kode'";

        if ($conn->query($sql) === TRUE) {
            $response = [
                'status' => 'success',
                'message' => 'Data buku berhasil diperbarui.'
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
            'message' => 'Data yang diperlukan tidak lengkap.'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Metode request yang tidak valid.'
    ];
}

echo json_encode($response);
?>
