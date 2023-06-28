<?php
// Include file koneksi.php untuk mendapatkan koneksi ke database
include 'koneksi.php';
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Header: Content-Type');
header('Access-Control-Allow-Method: GET, POST, OPTION, DELETE');

// Mendapatkan data yang dikirim melalui metode POST
$nomor = isset($_POST['nomor']) ? $_POST['nomor'] : '';

try {
    // Establish database connection
    $conn = getConnection();

    // Query SQL untuk menghapus data anggota berdasarkan nomor
    $query = "DELETE FROM anggota WHERE nomor = :nomor";

    // Mempersiapkan statement PDO untuk eksekusi query
    $statement = $conn->prepare($query);

    // Mengikat parameter dengan nilai yang sesuai
    $statement->bindParam(':nomor', $nomor);

    // Eksekusi statement
    $statement->execute();

    // Mengembalikan response sukses
    $response = [
        'status' => 'success',
        'message' => 'Data anggota berhasil dihapus'
    ];
} catch(PDOException $e) {
    // Jika terjadi error, tampilkan pesan error
    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat menghapus data anggota: ' . $e->getMessage()
    ];
}

// Mengirimkan response JSON
echo json_encode($response);

// Menutup koneksi
$conn = null;
?>
