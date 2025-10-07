-- ============================================
-- TechStore Database Dump
-- Proyecto: Sistema de Gestión de Productos Tecnológicos
-- Hosting: InfinityFree - if0_40011644_techstore_db
-- Fecha: Septiembre 2024
-- ============================================

-- Crear base de datos si no existe
CREATE DATABASE IF NOT EXISTS `if0_40011644_techstore_db`
DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `if0_40011644_techstore_db`;

-- ============================================
-- Estructura de tabla: categorias
-- ============================================

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Datos iniciales para tabla: categorias
-- ============================================

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Smartphones', 'Teléfonos móviles y accesorios'),
(2, 'Laptops', 'Computadoras portátiles'),
(3, 'Componentes PC', 'Procesadores, tarjetas gráficas, RAM, etc.'),
(4, 'Audio', 'Audífonos, parlantes, micrófonos'),
(5, 'Gaming', 'Consolas, juegos, accesorios gaming'),
(6, 'Wearables', 'Smartwatches, fitness trackers');

-- ============================================
-- Estructura de tabla: productos
-- ============================================

CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `marca` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int(11) DEFAULT '0',
  `imagen_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Datos iniciales para tabla: productos
-- ============================================

INSERT INTO `productos` (`id`, `nombre`, `categoria`, `precio`, `descripcion`, `marca`, `stock`, `imagen_url`, `fecha_creacion`) VALUES
(1, 'iPhone 15 Pro', 'Smartphones', '5499900.00', 'Último modelo de iPhone con chip A17 Pro', 'Apple', 25, 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=400&h=300&fit=crop', '2024-09-25 10:00:00'),
(2, 'MacBook Pro M3', 'Laptops', '10599900.00', 'Laptop profesional con chip M3 y 16GB RAM', 'Apple', 15, 'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?w=400&h=300&fit=crop', '2024-09-25 10:15:00'),
(3, 'NVIDIA RTX 4080', 'Componentes PC', '5099900.00', 'Tarjeta gráfica de alta gama para gaming', 'NVIDIA', 8, 'https://images.unsplash.com/photo-1591488320449-011701bb6704?w=400&h=300&fit=crop', '2024-09-25 10:30:00'),
(4, 'Sony WH-1000XM5', 'Audio', '1699900.00', 'Audífonos inalámbricos con cancelación de ruido', 'Sony', 30, 'https://images.unsplash.com/photo-1583394838336-acd977736f90?w=400&h=300&fit=crop', '2024-09-25 10:45:00'),
(5, 'PlayStation 5', 'Gaming', '2199900.00', 'Consola de videojuegos de nueva generación', 'Sony', 12, 'https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=400&h=300&fit=crop', '2024-09-25 11:00:00'),
(6, 'Apple Watch Series 9', 'Wearables', '1699900.00', 'Smartwatch con GPS y monitoreo de salud', 'Apple', 20, 'https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=400&h=300&fit=crop', '2024-09-25 11:15:00'),
(7, 'Samsung Galaxy S24', 'Smartphones', '3899900.00', 'Smartphone Android con cámara de 200MP', 'Samsung', 35, 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&h=300&fit=crop', '2024-09-25 11:30:00'),
(8, 'Dell XPS 15', 'Laptops', '8099900.00', 'Laptop premium con pantalla OLED 4K', 'Dell', 18, 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop', '2024-09-25 11:45:00');

-- ============================================
-- Configuración final
-- ============================================

-- Reiniciar contadores AUTO_INCREMENT
ALTER TABLE `categorias` AUTO_INCREMENT = 7;
ALTER TABLE `productos` AUTO_INCREMENT = 9;

-- Configurar charset y collation por defecto
SET NAMES utf8mb4;

-- ============================================
-- Consultas de verificación
-- ============================================

-- Verificar datos insertados
-- SELECT COUNT(*) as total_categorias FROM categorias;
-- SELECT COUNT(*) as total_productos FROM productos;
-- SELECT categoria, COUNT(*) as productos_por_categoria FROM productos GROUP BY categoria;

-- ============================================
-- Fin del dump
-- ============================================