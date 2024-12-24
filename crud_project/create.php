<?php
// Memeriksa apakah data dikirim menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $name = $_POST["name"];
    $email = $_POST["email"];
    // Membersihkan nomor telepon dari karakter non-numerik
    $phone = substr(preg_replace('/[^0-9]/', '', $_POST["phone"]), 0, 13);

    // Membuat koneksi ke database
    $conn = new mysqli("localhost", "root", "", "crud_db");

    // Memeriksa apakah koneksi berhasil
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Menyusun query SQL untuk memasukkan data ke tabel users
    $sql = "INSERT INTO pendaftar (name, email, phone) VALUES ('$name', '$email', '$phone')";

    // Mengeksekusi query dan memeriksa apakah berhasil
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect ke halaman utama jika berhasil
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // Menampilkan pesan kesalahan jika gagal
    }

    // Menutup koneksi ke database
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Pengguna</title>
    <style>
        /* Gaya untuk seluruh halaman */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
        }

        /* Gaya untuk form */
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        /* Gaya untuk judul form */
        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Gaya untuk label */
        .form-container label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        /* Gaya untuk input */
        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        /* Gaya untuk tombol submit */
        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Gaya saat tombol dihover */
        .form-container button:hover {
            background-color: #45a049;
        }

        /* Gaya untuk pesan sukses */
        .success-message {
            text-align: center;
            color: #28a745;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah Pengguna Baru</h2>
        <form method="POST" action="#">
            <label for="name">Nama:</label>
            <input type="text" name="name" required placeholder="Masukkan nama Anda">
            
            <label for="email">Email:</label>
            <input type="email" name="email" required placeholder="Masukkan email Anda">
            
            <label for="phone">Telepon:</label>
            <input type="text" name="phone" required placeholder="Masukkan nomor telepon Anda">
            
            <button type="submit">Simpan</button>
        </form>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
            <p class="success-message">Pengguna berhasil ditambahkan!</p>
        <?php endif; ?>
    </div>
</body>
</html>
