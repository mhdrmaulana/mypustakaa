<?php
// Include file koneksi.php untuk mendapatkan koneksi ke database
include 'koneksi.php';

// Mendapatkan data yang dikirim melalui metode POST
$nomor = isset($_POST['nomor']) ? $_POST['nomor'] : '';
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '';
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$no_hp = isset($_POST['no_hp']) ? $_POST['no_hp'] : '';
$tanggal_terdaftar = isset($_POST['tanggal_terdaftar']) ? $_POST['tanggal_terdaftar'] : '';

try {
    // Establish database connection
    $conn = getConnection();

    // Query SQL untuk memilih data anggota berdasarkan nomor
    $query = "SELECT * FROM anggota WHERE nomor = :nomor";

    // Mempersiapkan statement PDO untuk eksekusi query
    $statement = $conn->prepare($query);

    // Mengikat parameter dengan nilai yang sesuai
    $statement->bindParam(':nomor', $nomor);

    // Eksekusi statement
    $statement->execute();

    // Mendapatkan hasil seleksi
    $anggota = $statement->fetch(PDO::FETCH_ASSOC);

    // Jika data anggota ditemukan, lakukan update
    if ($anggota) {
        // Query SQL untuk mengupdate data anggota
        $updateQuery = "UPDATE anggota SET nama = :nama, jenis_kelamin = :jenis_kelamin, alamat = :alamat, no_hp = :no_hp, tanggal_terdaftar = :tanggal_terdaftar WHERE nomor = :nomor";

        // Mempersiapkan statement PDO untuk eksekusi query update
        $updateStatement = $conn->prepare($updateQuery);

        // Mengikat parameter dengan nilai yang sesuai
        $updateStatement->bindParam(':nama', $nama);
        $updateStatement->bindParam(':jenis_kelamin', $jenis_kelamin);
        $updateStatement->bindParam(':alamat', $alamat);
        $updateStatement->bindParam(':no_hp', $no_hp);
        $updateStatement->bindParam(':tanggal_terdaftar', $tanggal_terdaftar);
        $updateStatement->bindParam(':nomor', $nomor);

        // Eksekusi statement update
        $updateStatement->execute();

        // Mengembalikan response sukses
        $response = [
            'status' => 'success',
            'message' => 'Data anggota berhasil diupdate'
        ];
    } else {
        // Jika data anggota tidak ditemukan
        $response = [
            'status' => 'error',
            'message' => 'Data anggota tidak ditemukan'
        ];
    }
} catch(PDOException $e) {
    // Jika terjadi error, tampilkan pesan error
    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat mengupdate data anggota: ' . $e->getMessage()
    ];
}

// Mengirimkan response JSON
echo json_encode($response);

// Menutup koneksi
$conn = null;
?>
