class Petshop:
    __id = 0          # Variabel private untuk menyimpan ID produk
    __name = ""       # Variabel private untuk menyimpan nama produk
    __category = ""   # Variabel private untuk menyimpan kategori produk
    __price = 0.0     # Variabel private untuk menyimpan harga produk

    def __init__(self, id=0, name="", category="", price=0.0):
        """
        Konstruktor untuk kelas Petshop.
        Menginisialisasi objek dengan ID, nama, kategori, dan harga produk.
        """
        self.__id = id
        self.__name = name
        self.__category = category
        self.__price = price
    
    def get_id(self):
        """Mengembalikan ID produk."""
        return self.__id
    
    def set_id(self, id):
        """Mengatur ID produk dengan nilai baru."""
        self.__id = id
    
    def get_name(self):
        """Mengembalikan nama produk."""
        return self.__name
    
    def set_name(self, name):
        """Mengatur nama produk dengan nilai baru."""
        self.__name = name
    
    def get_category(self):
        """Mengembalikan kategori produk."""
        return self.__category
    
    def set_category(self, category):
        """Mengatur kategori produk dengan nilai baru."""
        self.__category = category
    
    def get_price(self):
        """Mengembalikan harga produk."""
        return self.__price
    
    def set_price(self, price):
        """Mengatur harga produk dengan nilai baru."""
        self.__price = price
