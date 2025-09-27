<?php
class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $pdo;

    public function __construct() {
        try {
            // Cargar configuración según el ambiente
            $this->loadConfig();

            // Detectar entorno: usar MySQL en producción, SQLite en desarrollo local
            if ($this->isProduction()) {
                $this->connectMySQL();
            } else {
                $this->connectSQLite();
            }

            $this->createTables();
            $this->insertInitialData();
        } catch(PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    private function loadConfig() {
        if ($this->isProduction()) {
            // Configuración para producción (InfinityFree)
            $this->host = 'sql303.infinityfree.com';
            $this->dbname = 'if0_40011644_techstore_db';
            $this->username = 'if0_40011644';
            $this->password = 'lqdc0hq28Ya977';
        } else {
            // Configuración para desarrollo local (MySQL opcional)
            $this->host = 'localhost';
            $this->dbname = 'techstore_db';
            $this->username = 'root';
            $this->password = '';
        }
    }

    private function isProduction() {
        // Detectar si estamos en InfinityFree u otro hosting
        // También forzar MySQL si la variable DEBUG_MYSQL está definida
        return (isset($_SERVER['SERVER_NAME']) &&
               strpos($_SERVER['SERVER_NAME'], 'infinityfree') !== false) ||
               getenv('DEBUG_MYSQL') === 'true';
    }

    private function connectMySQL() {
        if ($this->isProduction()) {
            // Configuración específica para InfinityFree
            $dsn = "mysql:host={$this->host};port=3306;dbname={$this->dbname};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_TIMEOUT => 30,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ];
        } else {
            // Configuración para desarrollo local
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
        }

        $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
    }

    private function connectSQLite() {
        // Para desarrollo local
        $dbPath = __DIR__ . '/../database/techstore.db';

        // Crear directorio si no existe
        $dbDir = dirname($dbPath);
        if (!is_dir($dbDir)) {
            mkdir($dbDir, 0755, true);
        }

        $this->pdo = new PDO('sqlite:' . $dbPath);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }


    public function getConnection() {
        return $this->pdo;
    }

    private function createTables() {
        if ($this->isProduction()) {
          // Sintaxis MySQL para producción
            $sqlUsuarios = "CREATE TABLE usuarios (
              id INT PRIMARY KEY AUTO_INCREMENT,
              username VARCHAR(50) UNIQUE NOT NULL,
              email VARCHAR(100) UNIQUE NOT NULL,
              password_hash VARCHAR(255) NOT NULL,
              nombre_completo VARCHAR(100) NOT NULL,
              rol ENUM('admin', 'usuario') DEFAULT 'usuario',
              fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
              activo BOOLEAN DEFAULT TRUE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
            $sqlProductos = "CREATE TABLE IF NOT EXISTS productos (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(255) NOT NULL,
                categoria VARCHAR(100) NOT NULL,
                precio DECIMAL(10,2) NOT NULL,
                descripcion TEXT,
                marca VARCHAR(100),
                stock INT DEFAULT 0,
                imagen_url VARCHAR(500),
                fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            $sqlCategorias = "CREATE TABLE IF NOT EXISTS categorias (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) UNIQUE NOT NULL,
                descripcion TEXT
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        } else {
          // Sintaxis SQLite para desarrollo local
            $sqlUsuarios = "CREATE TABLE usuarios (
              id INT PRIMARY KEY AUTO_INCREMENT,
              username VARCHAR(50) UNIQUE NOT NULL,
              email VARCHAR(100) UNIQUE NOT NULL,
              password_hash VARCHAR(255) NOT NULL,
              nombre_completo VARCHAR(100) NOT NULL,
              rol ENUM('admin', 'usuario') DEFAULT 'usuario',
              fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
              activo BOOLEAN DEFAULT TRUE
            )";
            $sqlProductos = "CREATE TABLE IF NOT EXISTS productos (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nombre TEXT NOT NULL,
                categoria TEXT NOT NULL,
                precio REAL NOT NULL,
                descripcion TEXT,
                marca TEXT,
                stock INTEGER DEFAULT 0,
                imagen_url TEXT,
                fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
            )";

            $sqlCategorias = "CREATE TABLE IF NOT EXISTS categorias (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nombre TEXT UNIQUE NOT NULL,
                descripcion TEXT
            )";
        }

                $this->pdo->exec($sqlProductos);

        $this->pdo->exec($sqlUsuarios);
        $this->pdo->exec($sqlProductos);
        $this->pdo->exec($sqlCategorias);
    }

    private function insertInitialData() {
        // Verificar si ya existen usuarios
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM usuarios");
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            $usuarios = [
              ['admin', 'admin@techstore.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador Principal', 'admin'],
            ];

            $stmt = $this->pdo->prepare("INSERT INTO usuarios (username, email, password_hash, nombre_completo, rol, fecha_creacion, activo) VALUES (?, ?, ?, ?, ?)");
            foreach ($usuarios as $usuario) {
                $stmt->execute($usuario);
            }
        }

        // Verificar si ya existen categorías
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM categorias");
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            $categorias = [
                ['Smartphones', 'Teléfonos móviles y accesorios'],
                ['Laptops', 'Computadoras portátiles'],
                ['Componentes PC', 'Procesadores, tarjetas gráficas, RAM, etc.'],
                ['Audio', 'Audífonos, parlantes, micrófonos'],
                ['Gaming', 'Consolas, juegos, accesorios gaming'],
                ['Wearables', 'Smartwatches, fitness trackers']
            ];

            $stmt = $this->pdo->prepare("INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)");
            foreach ($categorias as $categoria) {
                $stmt->execute($categoria);
            }
        }

        // Verificar si ya existen productos
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM productos");
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            $productos = [
                ['iPhone 15 Pro', 'Smartphones', 5499900.00, 'Último modelo de iPhone con chip A17 Pro', 'Apple', 25, 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=400&h=300&fit=crop'],
                ['MacBook Pro M3', 'Laptops', 10599900.00, 'Laptop profesional con chip M3 y 16GB RAM', 'Apple', 15, 'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?w=400&h=300&fit=crop'],
                ['NVIDIA RTX 4080', 'Componentes PC', 5099900.00, 'Tarjeta gráfica de alta gama para gaming', 'NVIDIA', 8, 'https://images.unsplash.com/photo-1591488320449-011701bb6704?w=400&h=300&fit=crop'],
                ['Sony WH-1000XM5', 'Audio', 1699900.00, 'Audífonos inalámbricos con cancelación de ruido', 'Sony', 30, 'https://images.unsplash.com/photo-1583394838336-acd977736f90?w=400&h=300&fit=crop'],
                ['PlayStation 5', 'Gaming', 2199900.00, 'Consola de videojuegos de nueva generación', 'Sony', 12, 'https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=400&h=300&fit=crop'],
                ['Apple Watch Series 9', 'Wearables', 1699900.00, 'Smartwatch con GPS y monitoreo de salud', 'Apple', 20, 'https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=400&h=300&fit=crop'],
                ['Samsung Galaxy S24', 'Smartphones', 3899900.00, 'Smartphone Android con cámara de 200MP', 'Samsung', 35, 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&h=300&fit=crop'],
                ['Dell XPS 15', 'Laptops', 8099900.00, 'Laptop premium con pantalla OLED 4K', 'Dell', 18, 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop']
            ];

            $stmt = $this->pdo->prepare("INSERT INTO productos (nombre, categoria, precio, descripcion, marca, stock, imagen_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
            foreach ($productos as $producto) {
                $stmt->execute($producto);
            }
        }
    }
}
