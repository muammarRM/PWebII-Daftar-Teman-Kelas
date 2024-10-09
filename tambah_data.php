<?php
session_start();
include 'koneksi.php';

// Menangkap data yang dikirim dari form
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telp = $_POST['telp'];

try {
    // Menyimpan data ke database
    $sql = "INSERT INTO mahasiswa (nim, nama, alamat, telp) VALUES ('$nim', '$nama', '$alamat', '$telp')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?notif=tambah_berhasil");
    } else {
        throw new Exception("Error: " . $sql . "<br>" . $conn->error);
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "NIM sudah ada dalam database.";
    header("Location: index.php?notif=tambah_gagal");
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: index.php?notif=tambah_gagal");
}

?>
