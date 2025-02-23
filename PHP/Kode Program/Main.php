<?php
session_start(); // Memulai sesi PHP untuk menyimpan data antar halaman
require 'Action.php'; // Mengimpor file Action.php yang berisi fungsi utama
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Shop</title>
    <style>
        /* Styling dasar untuk tampilan halaman */
        body { background-color: black; color: white; font-family: monospace; padding: 20px; }
        table { width: 70%; border-collapse: collapse; }
        th, td { border: 1px solid white; padding: 10px; text-align: left; }
        button, input { background-color: black; color: white; border: 1px solid white; padding: 5px; }
    </style>
</head>
<body>
    <h1>Chi Shop</h1>

    <!-- Form untuk memilih perintah -->
    <form method="GET">
        <label>Command:</label>
        <select name="command" required>
            <option value="show">Tampilkan Produk</option>
            <option value="add">Tambah Produk</option>
            <option value="update">Update Produk</option>
            <option value="find">Cari Produk</option> <!-- Opsi untuk mencari produk -->
        </select>
        <button type="submit">Submit</button>
    </form>

    <br>

    <?php
    if (isset($_GET['command'])) { // Memeriksa apakah ada perintah dari pengguna
        $command = $_GET['command']; // Menyimpan perintah dari input user

        if ($command == "show") { 
            showProducts($products); // Menampilkan daftar produk
        } elseif ($command == "add") {
            // Form untuk menambahkan produk baru
            echo '<form method="POST" enctype="multipart/form-data">
                    <label>Nama:</label><input type="text" name="name" required><br>
                    <label>Kategori:</label><input type="text" name="category" required><br>
                    <label>Harga:</label><input type="number" name="price" required><br>
                    <label>Gambar:</label><input type="file" name="image"><br>
                    <button type="submit">Tambah Produk</button>
                  </form>';
        } elseif ($command == "update") {
            // Form untuk memperbarui data produk
            echo '<form method="POST">
                    <label>Nama Produk:</label><input type="text" name="name" required><br>
                    <label>Pilih yang ingin diupdate:</label>
                    <select name="field">
                        <option value="category">Kategori</option>
                        <option value="price">Harga</option>
                    </select><br>
                    <label>Nilai Baru:</label><input type="text" name="new_value" required><br>
                    <button type="submit">Update</button>
                  </form>';
        } elseif ($command == "find") {
            // Form untuk mencari produk berdasarkan nama
            echo '<form method="GET">
                    <label>Nama Produk:</label><input type="text" name="name" required>
                    <input type="hidden" name="command" value="find">
                    <button type="submit">Cari</button>
                  </form>';

            // Jika ada input nama produk, jalankan fungsi pencarian
            if (isset($_GET['name'])) {
                $name = $_GET['name'];
                findProduct($name, $products); // Memanggil fungsi pencarian produk
            }
        }
    }
    ?>
</body>
</html>
