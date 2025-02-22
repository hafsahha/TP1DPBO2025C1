public class Petshop { // Mendeklarasikan class Petshop yang merepresentasikan produk petshop
    // Private attributes (Encapsulation)
    private int id;         // ID unik untuk setiap produk
    private String name;    // Nama produk
    private String category; // Kategori produk (misalnya: Makanan, Pasir, Aksesoris)
    private double price;   // Harga produk

    // Constructor default (tanpa parameter)
    public Petshop() { 
        this.id = 0;         // Default ID = 0
        this.name = "";      // Nama default kosong
        this.category = "";  // Kategori default kosong
        this.price = 0.0;    // Harga default 0.0
    }

    // Constructor dengan parameter untuk inisialisasi objek dengan nilai tertentu
    public Petshop(int id, String name, String category, double price) {
        this.id = id;           // Mengisi ID produk
        this.name = name;       // Mengisi Nama produk
        this.category = category; // Mengisi Kategori produk
        this.price = price;     // Mengisi Harga produk
    }

    // Getter dan Setter untuk mengakses dan mengubah atribut secara aman

    public int getId() {  // Mengambil ID produk
        return this.id;
    }

    public void setId(int id) { // Mengubah ID produk
        this.id = id;
    }

    public String getName() { // Mengambil Nama produk
        return this.name;
    }

    public void setName(String name) { // Mengubah Nama produk
        this.name = name;
    }

    public String getCategory() { // Mengambil Kategori produk
        return this.category;
    }

    public void setCategory(String category) { // Mengubah Kategori produk
        this.category = category;
    }

    public double getPrice() { // Mengambil Harga produk
        return this.price;
    }

    public void setPrice(double price) { // Mengubah Harga produk
        this.price = price;
    }
}
