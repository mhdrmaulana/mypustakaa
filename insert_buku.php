<?php
include 'koneksi.php';
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: GET, POST');

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

        // Query SQL untuk memasukkan data buku ke database
        $sql = "INSERT INTO buku (kode, kode_kategori, judul, pengarang, penerbit, tahun, tanggal_input, harga, file_cover)
                VALUES ('$kode', '$kode_kategori', '$judul', '$pengarang', '$penerbit', '$tahun', '$tanggal_input', '$harga', '$file_cover')";

        if ($conn->query($sql) === TRUE) {
            $response = [
                'status' => 'success',
                'message' => 'Data buku berhasil ditambahkan.'
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
