<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animasi Warna Mengelilingi Teks</title>
    <link rel="stylesheet" href="assets/style.css">
    <title>CRUD System</title>
</head>

<body>


<div class="container">
        <!-- Tambahkan baris ini untuk judul selamat datang -->
        <body>
        <h1 class="colorful-text">SELAMAT DATANG DI APLIKASI CRUD</h1>
</body>
    <div class="container">
    <form method="GET" action="">
                <input type="text" name="search" placeholder="Cari Pengguna..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit">Cari</button>
            </form>
        </div>
        <h2>Daftar Pengguna</h2>
        <a href="create.php" class="btn">Tambah Pengguna Baru</a>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Koneksi ke database
                    $conn = new mysqli("localhost", "root", "", "crud_db");
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Mengambil data dari tabel
                    $sql = "SELECT * FROM pendaftar";
                    $result = $conn->query($sql);

                        // Menangkap input pencarian
                        $search = isset($_GET['search']) ? $_GET['search'] : '';

                        // Modifikasi query untuk pencarian
                        $sql = "SELECT * FROM pendaftar WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%'";
                        $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
                            echo "<td>";
                            echo "<a href='update.php?id=" . htmlspecialchars($row["id"]) . "' class='btn-edit'>Edit</a>";
                            echo "<a href='delete.php?id=" . htmlspecialchars($row["id"]) . "' class='btn-delete'>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>


