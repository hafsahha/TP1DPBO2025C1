<?php

if (session_status() == PHP_SESSION_NONE) { // Cek apakah sesi sudah dimulai atau belum
    session_start(); // Memulai sesi jika belum dimulai
}

require 'Petshop.php'; // Memasukkan file yang berisi class Petshop

// Inisialisasi daftar produk jika ini adalah akses pertama kali
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = serialize([ // Menyimpan array objek Petshop dalam sesi setelah diserialisasi
        new Petshop(1, "RoyalCanin", "Makanan", 65000, "royalcanin.jpeg"),
        new Petshop(2, "EverClean", "Pasir", 30000, "everclean.jpg"),
        new Petshop(3, "Orijen", "Makanan", 180000, "orijen.webp"),
        new Petshop(4, "Fluval", "Aksesoris", 140000, "fluval.jpg"),
        new Petshop(5, "Oxbow", "Mainan", 80000, "oxbow.webp")
    ]);
}

$products = unserialize($_SESSION['products']); // Mengembalikan array objek Petshop dari sesi
$command = isset($_GET['command']) ? $_GET['command'] : ''; // Mengambil perintah dari URL (GET), jika ada

// Fungsi untuk menampilkan daftar produk dalam bentuk tabel
function showProducts($products) {
    echo "<table border='1' style='border-collapse: collapse; width: 70%; color: white;'>";
    echo "<tr><th>ID</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Gambar</th><th>Aksi</th></tr>";
    foreach ($products as $product) {
        echo "<tr>";
        echo "<td>{$product->getId()}</td>"; // Menampilkan ID produk
        echo "<td>{$product->getName()}</td>"; // Menampilkan Nama produk
        echo "<td>{$product->getCategory()}</td>"; // Menampilkan Kategori produk
        echo "<td>Rp" . number_format($product->getPrice(), 0, ',', '.') . "</td>"; // Menampilkan Harga produk dengan format Rupiah
        echo "<td><img src='uploads/{$product->getImage()}' width='50' onerror=\"this.src='uploads/default.png';\"></td>"; // Menampilkan gambar produk dengan fallback ke default jika gagal
        echo "<td>
                <a href='?command=delete&name={$product->getName()}'>Hapus</a> 
              </td>"; // Link untuk menghapus produk berdasarkan nama
        echo "</tr>";
    }
    echo "</table>";
}

// Tambah Produk ke dalam daftar
if ($_SERVER["REQUEST_METHOD"] == "POST" && $command == "add") {
    $name = $_POST['name']; // Mengambil nama produk dari input form
    $category = $_POST['category']; // Mengambil kategori produk dari input form
    $price = $_POST['price']; // Mengambil harga produk dari input form

    // Proses Upload Gambar
    if (!file_exists('uploads')) { mkdir('uploads', 0777, true); } // Membuat folder "uploads" jika belum ada
    $imageName = "default.png"; // Default gambar jika tidak ada gambar diunggah
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) { // Cek apakah file diunggah tanpa error
        $imageName = basename($_FILES['image']['name']); // Ambil nama file
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName); // Pindahkan file ke folder "uploads"
    }

    $new_id = count($products) + 1; // ID baru berdasarkan jumlah produk yang ada
    $products[] = new Petshop($new_id, $name, $category, $price, $imageName); // Tambahkan produk ke dalam daftar
    $_SESSION['products'] = serialize($products); // Simpan kembali daftar produk ke dalam sesi
    echo "Produk berhasil ditambahkan!"; // Pesan konfirmasi
}

// Hapus Produk dari daftar
if ($command == "delete" && isset($_GET['name'])) {
    $name = $_GET['name']; // Mengambil nama produk yang ingin dihapus dari URL
    foreach ($products as $key => $product) {
        if (strcasecmp($product->getName(), $name) == 0) { // Cek apakah nama produk cocok (case-insensitive)
            unset($products[$key]); // Hapus produk dari array
            $_SESSION['products'] = serialize(array_values($products)); // Simpan kembali daftar produk ke sesi
            echo "Produk '$name' berhasil dihapus!"; // Pesan konfirmasi
            break;
        }
    }
}

// Update Produk dalam daftar
if ($_SERVER["REQUEST_METHOD"] == "POST" && $command == "update") {
    $name = $_POST['name']; // Mengambil nama produk dari input form
    $field = $_POST['field']; // Mengambil field yang ingin diperbarui (kategori atau harga)
    $newValue = $_POST['new_value']; // Mengambil nilai baru

    foreach ($products as &$product) { // Looping melalui produk
        if (strcasecmp($product->getName(), $name) == 0) { // Jika nama cocok (case-insensitive)
            if ($field == "category") {
                $product->setCategory($newValue); // Update kategori produk
            } elseif ($field == "price") {
                $product->setPrice((int)$newValue); // Update harga produk (konversi ke integer)
            }
            $_SESSION['products'] = serialize($products); // Simpan kembali daftar produk ke sesi
            echo "Produk '$name' berhasil diperbarui!"; // Pesan konfirmasi
            break;
        }
    }
}

// Fungsi untuk mencari produk berdasarkan nama
function findProduct($name, $products) {
    foreach ($products as $product) {
        if (strcasecmp($product->getName(), $name) == 0) { // strcasecmp agar pencarian tidak case-sensitive
            echo "<p>Produk ditemukan:</p>";
            echo "<ul>";
            echo "<li><strong>Nama:</strong> {$product->getName()}</li>"; // Menampilkan nama produk
            echo "<li><strong>Kategori:</strong> {$product->getCategory()}</li>"; // Menampilkan kategori produk
            echo "<li><strong>Harga:</strong> Rp" . number_format($product->getPrice(), 0, ',', '.') . "</li>"; // Menampilkan harga produk
            echo "<li><strong>Gambar:</strong> <img src='uploads/{$product->getImage()}' width='50' onerror=\"this.src='uploads/default.png';\"></li>"; // Menampilkan gambar produk
            echo "</ul>";
            return $product; // Mengembalikan objek produk yang ditemukan
        }
    }
    echo "<p style='color: red;'>Produk tidak ditemukan.</p>"; // Pesan jika produk tidak ditemukan
    return null; // Mengembalikan null jika produk tidak ada
}
