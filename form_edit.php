<?php
include 'koneksi.php';

// Mendapatkan NIM dari URL
if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    // Mengambil data dari database
    $sql = "SELECT * FROM mahasiswa WHERE nim='$nim'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nim = $row["nim"];
        $nama = $row["nama"];
        $alamat = $row["alamat"];
        $telp = $row["telp"];
    } else {
        echo "Data tidak ditemukan";
        exit;
    }
} else {
    echo "NIM tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Data Teman</title>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Data Teman</h2>
    <form action="update_data.php" method="post">
        <div class="form-group">
            <label for="nim">Nim:</label>
            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo htmlspecialchars($nim); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo htmlspecialchars($alamat); ?>">
        </div>
        <div class="form-group">
            <label for="telp">No Telpon:</label>
            <input type="text" class="form-control" id="telp" name="telp" value="<?php echo htmlspecialchars($telp); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
