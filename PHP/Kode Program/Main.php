<?php
session_start();
require 'Action.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop Management</title>
    <style>
        body { background-color: black; color: white; font-family: monospace; padding: 20px; }
        table { width: 70%; border-collapse: collapse; }
        th, td { border: 1px solid white; padding: 10px; text-align: left; }
        button, input { background-color: black; color: white; border: 1px solid white; padding: 5px; }
    </style>
</head>
<body>
    <h1>Petshop Management</h1>
    
    <form method="GET">
        <label>Command:</label>
        <input type="text" name="command" required>
        <button type="submit">Submit</button>
    </form>
    
    <br>

    <?php
    if ($command == "show") {
        showProducts($products);
    } elseif ($command == "add") {
        echo '<form method="POST" enctype="multipart/form-data">
                <label>Nama:</label><input type="text" name="name" required><br>
                <label>Kategori:</label><input type="text" name="category" required><br>
                <label>Harga:</label><input type="number" name="price" required><br>
                <label>Gambar:</label><input type="file" name="image"><br>
                <button type="submit">Tambah Produk</button>
              </form>';
    } elseif ($command == "update") {
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
    }
    ?>
</body>
</html>
