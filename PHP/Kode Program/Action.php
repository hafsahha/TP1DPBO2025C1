<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'Petshop.php';

// Inisialisasi produk jika pertama kali akses
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = serialize([
        new Petshop(1, "RoyalCanin", "Makanan", 65000, "royalcanin.jpeg"),
        new Petshop(2, "EverClean", "Pasir", 30000, "everclean.jpg"),
        new Petshop(3, "Orijen", "Makanan", 180000, "orijen.webp"),
        new Petshop(4, "Fluval", "Aksesoris", 140000, "fluval.jpg"),
        new Petshop(5, "Oxbow", "Mainan", 80000, "oxbow.webp")
    ]);
}

$products = unserialize($_SESSION['products']);
$command = isset($_GET['command']) ? $_GET['command'] : '';

function showProducts($products) {
    echo "<table border='1' style='border-collapse: collapse; width: 70%; color: white;'>";
    echo "<tr><th>ID</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Gambar</th><th>Aksi</th></tr>";
    foreach ($products as $product) {
        echo "<tr>";
        echo "<td>{$product->getId()}</td>";
        echo "<td>{$product->getName()}</td>";
        echo "<td>{$product->getCategory()}</td>";
        echo "<td>Rp" . number_format($product->getPrice(), 0, ',', '.') . "</td>";
        echo "<td><img src='uploads/{$product->getImage()}' width='50' onerror=\"this.src='uploads/default.png';\"></td>";
        echo "<td>
                <a href='?command=delete&name={$product->getName()}'>Hapus</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Tambah Produk
if ($_SERVER["REQUEST_METHOD"] == "POST" && $command == "add") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    // Upload Gambar
    if (!file_exists('uploads')) { mkdir('uploads', 0777, true); }
    $imageName = "default.png";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
    }

    $new_id = count($products) + 1;
    $products[] = new Petshop($new_id, $name, $category, $price, $imageName);
    $_SESSION['products'] = serialize($products);
    echo "Produk berhasil ditambahkan!";
}

// Hapus Produk
if ($command == "delete" && isset($_GET['name'])) {
    $name = $_GET['name'];
    foreach ($products as $key => $product) {
        if (strcasecmp($product->getName(), $name) == 0) {
            unset($products[$key]);
            $_SESSION['products'] = serialize(array_values($products));
            echo "Produk '$name' berhasil dihapus!";
            break;
        }
    }
}

// Update Produk
if ($_SERVER["REQUEST_METHOD"] == "POST" && $command == "update") {
    $name = $_POST['name'];
    $field = $_POST['field'];
    $newValue = $_POST['new_value'];

    foreach ($products as &$product) {
        if (strcasecmp($product->getName(), $name) == 0) {
            if ($field == "category") {
                $product->setCategory($newValue);
            } elseif ($field == "price") {
                $product->setPrice((int)$newValue);
            }
            $_SESSION['products'] = serialize($products);
            echo "Produk '$name' berhasil diperbarui!";
            break;
        }
    }
}
?>
