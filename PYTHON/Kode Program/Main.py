from Petshop import Petshop  

def display_menu():
    # Menampilkan daftar perintah yang bisa digunakan
    print("\nMasukkan Command yang diinginkan:")
    print("- show  : Menampilkan daftar produk")
    print("- add   : Menambahkan produk baru")
    print("- update: Mengupdate atribut produk")
    print("- del   : Menghapus produk berdasarkan nama")
    print("- find  : Mencari produk berdasarkan nama")
    print("- exit  : Keluar dari program")

def show_products(data):
    # Menampilkan daftar produk jika ada, jika kosong tampilkan pesan
    if not data:
        print("Tidak ada produk yang tersedia.")
    else:
        print("+--------------------------------------------------------+")
        print("| NO  | ID   | Nama         | Kategori    | Harga        |")
        print("+--------------------------------------------------------+")
        for i, product in enumerate(data, start=1):
            # Menampilkan setiap produk dalam format tabel
            print(f"| {i:<3} | {product.get_id():<4} | {product.get_name():<12} | {product.get_category():<11} | Rp{product.get_price():<10} |")
        print("+--------------------------------------------------------+")

def main():
    # Inisialisasi daftar produk awal
    data = [
        Petshop(1, "RoyalCanin", "Makanan", 65000),
        Petshop(2, "EverClean", "Pasir", 30000),
        Petshop(3, "Orijen", "Makanan", 180000),
        Petshop(4, "Fluval", "Aksesoris", 140000),
        Petshop(5, "Oxbow", "Mainan", 80000)
    ]
    last_id = 5  # Menyimpan ID terakhir yang digunakan

    display_menu()  # Menampilkan menu pertama kali
    running = True  # Variabel kontrol untuk loop utama
    while running:
        command = input("\nMasukkan perintah: ").strip().lower()  # Input perintah dari user

        if command == "add":
            # Menambahkan produk baru ke dalam daftar
            name = input("Masukkan Nama Produk: ")
            category = input("Masukkan Kategori: ")
            price = float(input("Masukkan Harga: "))
            last_id += 1  # Menambah ID baru
            data.append(Petshop(last_id, name, category, price))  # Menambahkan produk
            print(f"Produk berhasil ditambahkan dengan ID: {last_id}")

        elif command == "del":
            # Menghapus produk berdasarkan nama
            search = input("Masukkan nama produk yang ingin dihapus: ")
            found = False  # Variabel untuk menandai apakah produk ditemukan
            it = 0  # Inisialisasi indeks
            while it < len(data) and not found:
                if data[it].get_name().lower() == search.lower():
                    del data[it]  # Hapus produk jika ditemukan
                    print("Produk berhasil dihapus.")
                    found = True  # Tandai bahwa produk sudah ditemukan
                else:
                    it += 1  # Lanjut ke produk berikutnya
            if not found:
                print("Produk tidak ditemukan.")

        elif command == "update":
            # Memperbarui atribut produk berdasarkan nama
            search = input("Masukkan nama produk yang ingin diperbarui: ")
            found = False  # Variabel untuk menandai apakah produk ditemukan
            it = 0  # Inisialisasi indeks
            while it < len(data) and not found:
                if data[it].get_name().lower() == search.lower():
                    found = True  # Tandai bahwa produk ditemukan
                    pilihan = input("Pilih atribut yang ingin diubah (nama/kategori/harga): ")
                    if pilihan == "nama":
                        data[it].set_name(input("Masukkan Nama baru: "))  # Update nama produk
                    elif pilihan == "kategori":
                        data[it].set_category(input("Masukkan Kategori baru: "))  # Update kategori
                    elif pilihan == "harga":
                        data[it].set_price(float(input("Masukkan Harga baru: ")))  # Update harga
                    else:
                        print("Atribut tidak dikenali.")  # Jika input atribut salah
                    print("Produk berhasil diperbarui.")
                else:
                    it += 1  # Lanjut ke produk berikutnya
            if not found:
                print("Produk tidak ditemukan.")

        elif command == "show":
            # Menampilkan semua produk yang ada
            show_products(data)

        elif command == "find":
            # Mencari produk berdasarkan nama
            search = input("Masukkan nama produk yang ingin dicari: ")
            found = False  # Variabel untuk menandai apakah produk ditemukan
            it = 0  # Inisialisasi indeks
            while it < len(data) and not found:
                if data[it].get_name().lower() == search.lower():
                    # Jika produk ditemukan, tampilkan detailnya
                    print(f"\nProduk ditemukan:\nID: {data[it].get_id()}\nNama: {data[it].get_name()}\nKategori: {data[it].get_category()}\nHarga: Rp{data[it].get_price()}")
                    found = True
                else:
                    it += 1  # Lanjut ke produk berikutnya
            if not found:
                print("Produk tidak ditemukan.")

        elif command == "exit":
            # Keluar dari program
            print("Keluar dari program.")
            running = False  # Menghentikan loop utama

        else:
            # Jika perintah tidak dikenali
            print("Command tidak dikenali.")

if __name__ == "__main__":
    main()
