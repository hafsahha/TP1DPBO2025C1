import java.util.*; 

public class Main {
    public static void main(String[] args) {
        List<Petshop> data = new LinkedList<>(); // Menggunakan LinkedList untuk menyimpan data produk petshop
        
        // Menambahkan beberapa produk awal ke dalam daftar
        data.add(new Petshop(1, "RoyalCanin", "Makanan", 65000));
        data.add(new Petshop(2, "EverClean", "Pasir", 30000));
        data.add(new Petshop(3, "Orijen", "Makanan", 180000));
        data.add(new Petshop(4, "Fluval", "Aksesoris", 140000));
        data.add(new Petshop(5, "Oxbow", "Mainan", 80000));
        
        int lastId = 5; // Menyimpan ID terakhir yang digunakan
        Scanner scanner = new Scanner(System.in); // Scanner untuk membaca input dari pengguna
        String command; // Variabel untuk menyimpan perintah dari pengguna
        
        // Menampilkan daftar perintah yang dapat digunakan
        System.out.println("Masukan Command yang diinginkan:\n- show\n- add\n- update\n- del\n- find\n- exit");
        
        do {
            System.out.print("\nMasukan perintah: ");
            command = scanner.next(); // Membaca perintah dari pengguna
            
            if (command.equals("add")) { // Menambahkan produk baru
                System.out.print("Masukan Nama Produk, Kategori, Harga: ");
                String name = scanner.next(); // Membaca nama produk
                String category = scanner.next(); // Membaca kategori produk
                double price = scanner.nextDouble(); // Membaca harga produk
                
                int newId = ++lastId; // Menambahkan ID baru secara otomatis
                data.add(new Petshop(newId, name, category, price)); // Menambahkan produk ke daftar
                System.out.println("Produk berhasil ditambahkan dengan ID: " + newId);
            } 
            else if (command.equals("del")) { // Menghapus produk berdasarkan nama
                System.out.print("Masukan nama produk yang ingin dihapus: ");
                String search = scanner.next();
                
                Iterator<Petshop> iterator = data.iterator(); // Menggunakan iterator untuk traversal
                boolean found = false; 
                while (iterator.hasNext() && !found) {
                    if (iterator.next().getName().equals(search)) { // Jika produk ditemukan
                        iterator.remove(); // Hapus produk dari daftar
                        found = true;
                        System.out.println("Produk berhasil dihapus.");
                    }
                }
                if (!found) System.out.println("Produk tidak ditemukan.");
            } 
            else if (command.equals("update")) { // Memperbarui produk berdasarkan nama
                System.out.print("Masukan nama produk yang ingin diperbarui: ");
                String search = scanner.next();

                Iterator<Petshop> iterator = data.iterator();
                boolean found = false;
                
                while (iterator.hasNext() && !found) {
                    Petshop p = iterator.next();
                    if (p.getName().equals(search)) { // Jika produk ditemukan
                        found = true;

                        System.out.println("Pilih atribut yang ingin diubah:\n- nama\n- kategori\n- harga\n- cancel");
                        System.out.print("Masukan atribut: ");
                        String pilihan = scanner.next();

                        if (pilihan.equals("nama")) { // Mengubah nama produk
                            System.out.print("Masukan Nama baru: ");
                            p.setName(scanner.next());
                        } else if (pilihan.equals("kategori")) { // Mengubah kategori produk
                            System.out.print("Masukan Kategori baru: ");
                            p.setCategory(scanner.next());
                        } else if (pilihan.equals("harga")) { // Mengubah harga produk
                            System.out.print("Masukan Harga baru: ");
                            p.setPrice(scanner.nextDouble());
                        } else if (pilihan.equals("cancel")) { // Membatalkan update
                            System.out.println("Update dibatalkan.");
                        } else {
                            System.out.println("Atribut tidak dikenali.");
                        }
                        System.out.println("Produk berhasil diperbarui.");
                    }
                }
                if (!found) System.out.println("Produk tidak ditemukan.");
            } 
            else if (command.equals("show")) { // Menampilkan semua produk
                if (data.isEmpty()) {
                    System.out.println("Tidak ada produk yang tersedia.");
                } else {
                    // Menampilkan tabel produk
                    System.out.println("+--------------------------------------------------------+");
                    System.out.println("| NO  | ID   | Nama         | Kategori    | Harga        |");
                    System.out.println("+--------------------------------------------------------+");

                    int i = 1;
                    for (Petshop p : data) { // Loop untuk menampilkan semua produk
                        System.out.printf("| %-3d | %-4d | %-12s | %-11s | Rp%-10.2f |\n", 
                                        i++, p.getId(), p.getName(), p.getCategory(), p.getPrice());
                    }
                    System.out.println("+--------------------------------------------------------+");
                }
            }
            else if (command.equals("find")) { // Mencari produk berdasarkan nama
                System.out.print("Masukan nama produk yang ingin dicari: ");
                String search = scanner.next();

                Iterator<Petshop> iterator = data.iterator();
                boolean found = false;
                
                while (iterator.hasNext() && !found) {
                    Petshop p = iterator.next();
                    if (p.getName().equals(search)) { // Jika produk ditemukan
                        System.out.println("Produk ditemukan:");
                        System.out.println("ID: " + p.getId());
                        System.out.println("Nama: " + p.getName());
                        System.out.println("Kategori: " + p.getCategory());
                        System.out.println("Harga: Rp" + p.getPrice());
                        found = true;
                    }
                }
                if (!found) System.out.println("Produk tidak ditemukan.");
            } 
            else if (!command.equals("exit")) { // Menampilkan pesan jika perintah tidak dikenali
                System.out.println("Command tidak dikenali.");
            }
        } while (!command.equals("exit")); // Program terus berjalan hingga pengguna memasukkan "exit"
        
        scanner.close(); // Menutup scanner untuk mencegah kebocoran sumber daya
    }
}
