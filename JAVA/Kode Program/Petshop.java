public class Petshop {
    // Private attributes
    private int id;         
    private String name;    
    private String category;
    private double price;   

    // Constructor default
    public Petshop() {
        this.id = 0;
        this.name = "";
        this.category = "";
        this.price = 0.0;
    }

    // Constructor dengan parameter
    public Petshop(int id, String name, String category, double price) {
        this.id = id;
        this.name = name;
        this.category = category;
        this.price = price;
    }

    // Getter dan Setter
    public int getId() {
        return this.id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getName() {
        return this.name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getCategory() {
        return this.category;
    }

    public void setCategory(String category) {
        this.category = category;
    }

    public double getPrice() {
        return this.price;
    }

    public void setPrice(double price) {
        this.price = price;
    }
}
