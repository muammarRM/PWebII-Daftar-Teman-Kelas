<?php
session_start();
include 'koneksi.php';

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telp = $_POST['telp'];

// Cek keberadaan data yang akan diupdate
$cekNIM = "SELECT nim FROM mahasiswa WHERE nim='$nim'";
$result = $conn->query($cekNIM);
if ($result->num_rows == 0) {
    $_SESSION['error'] = "Data dengan NIM: $nim tidak ditemukan.";
    header("Location: index.php?notif=update_gagal");
    exit;
}

// Jika data ditemukan, lanjutkan proses update
$sql = "UPDATE mahasiswa SET nama='$nama', alamat='$alamat', telp='$telp' WHERE nim='$nim'";
if ($conn->query($sql) === TRUE) {
    header("Location: index.php?notif=update_berhasil");
} else {
    $_SESSION['error'] = "Terjadi kesalahan saat mengupdate data: " . $conn->error;
    header("Location: index.php?notif=update_gagal");
}

?>
