<?php

class Petshop {
    private $id; // Properti untuk menyimpan ID produk
    private $name; // Properti untuk menyimpan nama produk
    private $category; // Properti untuk menyimpan kategori produk (misalnya: makanan, aksesoris, dll.)
    private $price; // Properti untuk menyimpan harga produk
    private $image; // Properti untuk menyimpan nama file gambar produk

    // Konstruktor untuk menginisialisasi objek Petshop dengan data yang diberikan
    public function __construct($id, $name, $category, $price, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
        $this->image = $image;
    }

    // Getter untuk mendapatkan ID produk
    public function getId() {
        return $this->id;
    }

    // Getter untuk mendapatkan nama produk
    public function getName() {
        return $this->name;
    }

    // Setter untuk mengubah nama produk
    public function setName($name) {
        $this->name = $name;
    }

    // Getter untuk mendapatkan kategori produk
    public function getCategory() {
        return $this->category;
    }

    // Setter untuk mengubah kategori produk
    public function setCategory($category) {
        $this->category = $category;
    }

    // Getter untuk mendapatkan harga produk
    public function getPrice() {
        return $this->price;
    }

    // Setter untuk mengubah harga produk
    public function setPrice($price) {
        $this->price = $price;
    }

    // Getter untuk mendapatkan nama file gambar produk
    public function getImage() {
        return $this->image;
    }
}
?>
