<?php
session_start();
include 'koneksi.php';

$nim = $_GET['nim'];

// Cek keberadaan data yang akan dihapus
$cekNIM = "SELECT nim FROM mahasiswa WHERE nim='$nim'";
$result = $conn->query($cekNIM);
if ($result->num_rows == 0) {
    $_SESSION['error'] = "Data dengan NIM: $nim tidak ditemukan.";
    header("Location: index.php?notif=hapus_gagal");
    exit;
}

// Jika data ditemukan, lanjutkan proses hapus
$sql = "DELETE FROM mahasiswa WHERE nim='$nim'";
if ($conn->query($sql) === TRUE) {
    header("Location: index.php?notif=hapus_berhasil");
} else {
    $_SESSION['error'] = "Terjadi kesalahan saat menghapus data: " . $conn->error;
    header("Location: index.php?notif=hapus_gagal");
}

?>
