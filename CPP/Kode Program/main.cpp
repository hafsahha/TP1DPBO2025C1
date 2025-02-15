#include <bits/stdc++.h>
#include <iomanip>  
#include "petshop.cpp"

using namespace std;

int main() {
    list<petshop> data; // Menggunakan std::list untuk menyimpan data produk
    
    // Menambahkan 5 produk awal ke dalam list
    data.push_back(petshop(1, "RoyalCanin", "Makanan", 65000));
    data.push_back(petshop(2, "EverClean", "Pasir", 30000));
    data.push_back(petshop(3, "Orijen", "Makanan", 180000));
    data.push_back(petshop(4, "Fluval", "Aksesoris", 140000));
    data.push_back(petshop(5, "Oxbow", "Mainan", 80000));

    int last_id = 5;    // Menyimpan ID terakhir yang digunakan agar ID baru auto-increment
    string command;     // Variabel untuk menyimpan perintah dari pengguna

    // Menampilkan daftar command yang bisa digunakan oleh pengguna
    cout << "Masukan Command yang diinginkan:\n- show\n- add\n- update\n- del\n- find\n- exit\n";

    do {
        cout << "\nMasukan perintah: ";
        cin >> command; // Menerima input command dari pengguna

        if (command == "add") {  // Menambah produk baru ke dalam list
            string name, category;
            double price;

            cout << "Masukan Nama Produk, Kategori, Harga: ";
            cin >> name >> category >> price; // Input nama, kategori, dan harga produk

            int new_id = ++last_id; // Auto-increment ID baru

            petshop temp(new_id, name, category, price);
            data.push_back(temp); // Menambahkan produk baru ke dalam list

            cout << "Produk berhasil ditambahkan dengan ID: " << new_id << "\n";
        } 
        else if (command == "del") {  // Menghapus produk berdasarkan nama
            string search;
            bool found = false;

            cout << "Masukan nama produk yang ingin dihapus: ";
            cin >> search;

            auto it = data.begin();
            while (it != data.end() && !found) {
                if (it->get_name() == search) {
                    it = data.erase(it); // Menghapus elemen dari list
                    found = true;
                    cout << "Produk berhasil dihapus.\n";
                } else {
                    ++it;
                }
            }

            if (!found) cout << "Produk tidak ditemukan.\n";
        } 
        else if (command == "update") {  // Memperbarui data produk
            string search;
            bool found = false;

            cout << "Masukan nama produk yang ingin diperbarui: ";
            cin >> search;

            auto it = data.begin();
            while (it != data.end() && !found) {
                if (it->get_name() == search) {
                    found = true;
                    string pilihan;

                    cout << "Pilih atribut yang ingin diubah:\n";
                    cout << "- nama\n- kategori\n- harga\n- cancel (batal)\n";

                    cout << "Masukan atribut: ";
                    cin >> pilihan;

                    if (pilihan == "nama") {
                        string new_name;
                        cout << "Masukan Nama baru: ";
                        cin >> new_name;
                        it->set_name(new_name);
                    } 
                    else if (pilihan == "kategori") {
                        string new_category;
                        cout << "Masukan Kategori baru: ";
                        cin >> new_category;
                        it->set_category(new_category);
                    } 
                    else if (pilihan == "harga") {
                        double new_price;
                        cout << "Masukan Harga baru: ";
                        cin >> new_price;
                        it->set_price(new_price);
                    } 
                    else if (pilihan == "cancel") {
                        cout << "Update dibatalkan.\n";
                    } 
                    else {
                        cout << "Atribut tidak dikenali.\n";
                    }

                    cout << "Produk berhasil diperbarui.\n";
                } else {
                    ++it;
                }
            }

            if (!found) cout << "Produk tidak ditemukan.\n";
        } 
        else if (command == "show") {  // Menampilkan daftar produk dalam bentuk tabel
            if (data.empty()) {
                cout << "Tidak ada produk yang tersedia.\n";
            } else {
                // Menampilkan header tabel
                cout << "+--------------------------------------------------------+\n";
                cout << "| NO  | ID   | Nama         | Kategori    | Harga        |\n";
                cout << "+--------------------------------------------------------+\n";

                int i = 1;
                for (auto it = data.begin(); it != data.end(); ++it) {
                    // Menampilkan setiap produk dengan format tabel
                    cout << "| " << left << setw(3) << i << " | " 
                        << left << setw(4) << it->get_id() << " | "
                        << left << setw(12) << it->get_name() << " | "
                        << left << setw(11) << it->get_category() << " | "
                        << "Rp" << left << setw(10) << it->get_price() << " |\n";
                    i++;
                }
                cout << "+--------------------------------------------------------+\n";
            }
        }
        else if (command == "find") {  // Mencari produk berdasarkan nama
            string search;
            bool found = false;

            cout << "Masukan nama produk yang ingin dicari: ";
            cin >> search;

            auto it = data.begin();
            while (it != data.end() && !found) {
                if (it->get_name() == search) {
                    // Menampilkan detail produk jika ditemukan
                    cout << "Produk ditemukan:\n";
                    cout << "ID: " << it->get_id() << "\nNama: " << it->get_name() 
                         << "\nKategori: " << it->get_category() 
                         << "\nHarga: Rp" << it->get_price() << "\n";
                    found = true;
                } else {
                    ++it;
                }
            }

            if (!found) cout << "Produk tidak ditemukan.\n";
        } 
        else if (command != "exit") {  // Jika command tidak dikenali
            cout << "Command tidak dikenali.\n";
        }

    } while (command != "exit");  // Program terus berjalan hingga command "exit" dimasukkan

    return 0;
}
