#include <iostream>
#include <string>

using namespace std;

// Deklarasi kelas petshop yang merepresentasikan produk di toko hewan peliharaan
class petshop
{
    private:
        int id;             // ID untuk setiap produk
        string name;        // Nama produk
        string category;    // Kategori produk (Makanan, Aksesoris, dll.)
        double price;       // Harga produk

    public:
        // Konstruktor default (tanpa parameter), menginisialisasi atribut dengan nilai default
        petshop() {
            this->id = 0;
            this->name = "";
            this->category = "";
            this->price = 0.0;
        }

        // Konstruktor dengan parameter untuk menginisialisasi objek dengan nilai yang diberikan
        petshop(int id, string name, string category, double price) {
            this->id = id;
            this->name = name;
            this->category = category;
            this->price = price;
        }

        // Getter untuk ID produk
        int get_id() {
            return this->id;
        }

        // Setter untuk mengubah ID produk
        void set_id(int id) {
            this->id = id;
        }

        // Getter untuk mendapatkan nama produk
        string get_name() {
            return this->name;
        }

        // Setter untuk mengubah nama produk
        void set_name(string name) {
            this->name = name;
        }

        // Getter untuk mendapatkan kategori produk
        string get_category() {
            return this->category;
        }

        // Setter untuk mengubah kategori produk
        void set_category(string category) {
            this->category = category;
        }

        // Getter untuk mendapatkan harga produk
        double get_price() {
            return this->price;
        }

        // Setter untuk mengubah harga produk
        void set_price(double price) {
            this->price = price;
        }

        // Destruktor
        ~petshop()
        {
            
        }
};
