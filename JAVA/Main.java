import java.util.*;

public class Main {
    public static void main(String[] args) {
        List<Petshop> data = new LinkedList<>();
        
        data.add(new Petshop(1, "RoyalCanin", "Makanan", 65000));
        data.add(new Petshop(2, "EverClean", "Pasir", 30000));
        data.add(new Petshop(3, "Orijen", "Makanan", 180000));
        data.add(new Petshop(4, "Fluval", "Aksesoris", 140000));
        data.add(new Petshop(5, "Oxbow", "Mainan", 80000));
        
        int lastId = 5;
        Scanner scanner = new Scanner(System.in);
        String command;
        
        System.out.println("Masukan Command yang diinginkan:\n- show\n- add\n- update\n- del\n- find\n- exit");
        
        do {
            System.out.print("\nMasukan perintah: ");
            command = scanner.next();
            
            if (command.equals("add")) {
                System.out.print("Masukan Nama Produk, Kategori, Harga: ");
                String name = scanner.next();
                String category = scanner.next();
                double price = scanner.nextDouble();
                
                int newId = ++lastId;
                data.add(new Petshop(newId, name, category, price));
                System.out.println("Produk berhasil ditambahkan dengan ID: " + newId);
            } 
            else if (command.equals("del")) {
                System.out.print("Masukan nama produk yang ingin dihapus: ");
                String search = scanner.next();
                
                Iterator<Petshop> iterator = data.iterator();
                boolean found = false;
                while (iterator.hasNext()) {
                    if (iterator.next().getName().equals(search)) {
                        iterator.remove();
                        found = true;
                        System.out.println("Produk berhasil dihapus.");
                        break;
                    }
                }
                if (!found) System.out.println("Produk tidak ditemukan.");
            } 
            else if (command.equals("update")) {
                System.out.print("Masukan nama produk yang ingin diperbarui: ");
                String search = scanner.next();
                
                boolean found = false;
                for (Petshop p : data) {
                    if (p.getName().equals(search)) {
                        found = true;
                        
                        System.out.println("Pilih atribut yang ingin diubah:\n- nama\n- kategori\n- harga\n- cancel");
                        System.out.print("Masukan atribut: ");
                        String pilihan = scanner.next();
                        
                        if (pilihan.equals("nama")) {
                            System.out.print("Masukan Nama baru: ");
                            p.setName(scanner.next());
                        } else if (pilihan.equals("kategori")) {
                            System.out.print("Masukan Kategori baru: ");
                            p.setCategory(scanner.next());
                        } else if (pilihan.equals("harga")) {
                            System.out.print("Masukan Harga baru: ");
                            p.setPrice(scanner.nextDouble());
                        } else if (pilihan.equals("cancel")) {
                            System.out.println("Update dibatalkan.");
                        } else {
                            System.out.println("Atribut tidak dikenali.");
                        }
                        System.out.println("Produk berhasil diperbarui.");
                        break;
                    }
                }
                if (!found) System.out.println("Produk tidak ditemukan.");
            } 
            else if (command.equals("show")) {
                if (data.isEmpty()) {
                    System.out.println("Tidak ada produk yang tersedia.");
                } else {
                    System.out.println("+--------------------------------------------------------+");
                    System.out.println("| NO  | ID   | Nama         | Kategori    | Harga        |");
                    System.out.println("+--------------------------------------------------------+");

                    int i = 1;
                    for (Petshop p : data) {
                        System.out.printf("| %-3d | %-4d | %-12s | %-11s | Rp%-10.2f |\n", 
                                        i++, p.getId(), p.getName(), p.getCategory(), p.getPrice());
                    }
                    System.out.println("+--------------------------------------------------------+");
                }
            }
            else if (command.equals("find")) {
                System.out.print("Masukan nama produk yang ingin dicari: ");
                String search = scanner.next();
                
                boolean found = false;
                for (Petshop p : data) {
                    if (p.getName().equals(search)) {
                        System.out.println("Produk ditemukan:");
                        System.out.println("ID: " + p.getId());
                        System.out.println("Nama: " + p.getName());
                        System.out.println("Kategori: " + p.getCategory());
                        System.out.println("Harga: Rp" + p.getPrice());
                        found = true;
                        break;
                    }
                }
                if (!found) System.out.println("Produk tidak ditemukan.");
            } 
            else if (!command.equals("exit")) {
                System.out.println("Command tidak dikenali.");
            }
        } while (!command.equals("exit"));
        
        scanner.close();
    }
}
