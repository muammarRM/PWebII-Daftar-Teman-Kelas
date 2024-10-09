<?php
include 'koneksi.php';

$sql = "SELECT nim, nama, alamat, telp FROM mahasiswa";
$result = $conn->query($sql);
?>

<?php
session_start();

if (isset($_GET['notif'])):
    $notifType = 'success'; // Default ke 'success'
    $message = '';
    switch ($_GET['notif']) {
        case 'tambah_berhasil':
            $message = "Data berhasil ditambahkan!";
            break;
        case 'update_berhasil':
            $message = "Data berhasil diupdate!";
            break;
        case 'hapus_berhasil':
            $message = "Data berhasil dihapus!";
            break;
        case 'tambah_gagal':
        case 'update_gagal':
        case 'hapus_gagal':
            $notifType = 'danger'; // Ubah tipe notifikasi menjadi 'danger'
            $message = isset($_SESSION['error']) ? $_SESSION['error'] : "Operasi gagal.";
            unset($_SESSION['error']); // Hapus sesi error setelah ditampilkan
            break;
    }
?>
    <div class="alert alert-<?php echo $notifType; ?> alert-dismissible fade show" role="alert">
        <?php echo $message; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Teman Kelas</title>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
    <h2>Daftar Teman Kelas</h2>
    <a href="form_tambah.html" class="btn btn-primary">Tambah Data Teman</a>
    <br><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nim</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if ($result->num_rows > 0) {
                // output data setiap baris
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["nim"]."</td>
                            <td>".$row["nama"]."</td>
                            <td>".$row["alamat"]."</td>
                            <td>".$row["telp"]."</td>
                            <td>
                                <a href='form_edit.php?nim=".$row["nim"]."'>Edit</a>
                                <a href='hapus.php?nim=".$row["nim"]."' onclick='return confirm(\"Yakin ingin menghapus data?\")'>Hapus</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>0 results</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
