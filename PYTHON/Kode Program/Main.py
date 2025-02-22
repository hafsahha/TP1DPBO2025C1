from Petshop import Petshop  # Mengimpor kelas Petshop dari modul Petshop

def display_menu():
    # Menampilkan menu pilihan kepada pengguna
    print("\nMasukkan Command yang diinginkan:")
    print("- show  : Menampilkan daftar produk")
    print("- add   : Menambahkan produk baru")
    print("- update: Mengupdate atribut produk")
    print("- del   : Menghapus produk berdasarkan nama")
    print("- find  : Mencari produk berdasarkan nama")
    print("- exit  : Keluar dari program")

def show_products(data):
    # Menampilkan daftar produk yang ada dalam sistem
    if not data:
        print("Tidak ada produk yang tersedia.")
    else:
        print("+--------------------------------------------------------+")
        print("| NO  | ID   | Nama         | Kategori    | Harga        |")
        print("+--------------------------------------------------------+")
        for i, product in enumerate(data, start=1):
            print(f"| {i:<3} | {product.get_id():<4} | {product.get_name():<12} | {product.get_category():<11} | Rp{product.get_price():<10} |")
        print("+--------------------------------------------------------+")

def main():
    # Data awal produk yang tersedia
    data = [
        Petshop(1, "RoyalCanin", "Makanan", 65000),
        Petshop(2, "EverClean", "Pasir", 30000),
        Petshop(3, "Orijen", "Makanan", 180000),
        Petshop(4, "Fluval", "Aksesoris", 140000),
        Petshop(5, "Oxbow", "Mainan", 80000)
    ]
    last_id = 5  # Menyimpan ID terakhir yang digunakan

    display_menu()
    while True:
        command = input("\nMasukkan perintah: ").strip().lower()  # Membaca perintah pengguna

        if command == "add":
            # Menambahkan produk baru
            name = input("Masukkan Nama Produk: ")
            category = input("Masukkan Kategori: ")
            price = float(input("Masukkan Harga: "))
            last_id += 1  # Menambah ID baru
            data.append(Petshop(last_id, name, category, price))  # Menambahkan produk ke daftar
            print(f"Produk berhasil ditambahkan dengan ID: {last_id}")
        
        elif command == "del":
            # Menghapus produk berdasarkan nama
            search = input("Masukkan nama produk yang ingin dihapus: ")
            for product in data:
                if product.get_name().lower() == search.lower():
                    data.remove(product)  # Menghapus produk dari daftar
                    print("Produk berhasil dihapus.")
                    break
            else:
                print("Produk tidak ditemukan.")
        
        elif command == "update":
            # Memperbarui atribut produk
            search = input("Masukkan nama produk yang ingin diperbarui: ")
            for product in data:
                if product.get_name().lower() == search.lower():
                    pilihan = input("Pilih atribut yang ingin diubah (nama/kategori/harga): ")
                    if pilihan == "nama":
                        product.set_name(input("Masukkan Nama baru: "))
                    elif pilihan == "kategori":
                        product.set_category(input("Masukkan Kategori baru: "))
                    elif pilihan == "harga":
                        product.set_price(float(input("Masukkan Harga baru: ")))
                    else:
                        print("Atribut tidak dikenali.")
                    print("Produk berhasil diperbarui.")
                    break
            else:
                print("Produk tidak ditemukan.")
        
        elif command == "show":
            # Menampilkan daftar produk yang tersedia
            show_products(data)
        
        elif command == "find":
            # Mencari produk berdasarkan nama
            search = input("Masukkan nama produk yang ingin dicari: ")
            for product in data:
                if product.get_name().lower() == search.lower():
                    print(f"\nProduk ditemukan:\nID: {product.get_id()}\nNama: {product.get_name()}\nKategori: {product.get_category()}\nHarga: Rp{product.get_price()}")
                    break
            else:
                print("Produk tidak ditemukan.")
        
        elif command == "exit":
            # Keluar dari program
            print("Keluar dari program.")
            break
        
        else:
            print("Command tidak dikenali.")

if __name__ == "__main__":
    main()  # Menjalankan program utama
