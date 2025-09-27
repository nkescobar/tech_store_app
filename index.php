<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore - Gestión de Productos Tecnológicos</title>
    <link rel="stylesheet" href="static/css/styles.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <h1 class="nav-logo">🖥️ TechStore</h1>
                <button class="nav-toggle" onclick="toggleNavMenu()" aria-label="Abrir menú">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="nav-menu" id="navMenu">
                    <a href="#productos" class="nav-link" onclick="closeNavMenu()">Productos</a>
                    <a href="#agregar" class="nav-link" onclick="closeNavMenu()">Agregar</a>
                    <a href="#categorias" class="nav-link" onclick="closeNavMenu()">Categorías</a>
                    <a href="#estadisticas" class="nav-link" onclick="closeNavMenu()">Estadísticas</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section id="hero">
            <div class="hero-content">
                <h2>Sistema de Gestión de Productos Tecnológicos</h2>
                <p>Administra tu inventario de productos tech de manera eficiente con PHP</p>
            </div>
        </section>

        <section id="filtros" class="section">
            <div class="container">
                <h3>Filtrar Productos</h3>
                <div class="filter-controls">
                    <select id="categoriaFiltro">
                        <option value="">Todas las categorías</option>
                    </select>
                    <input type="text" id="busqueda" placeholder="Buscar productos...">
                    <button onclick="filtrarProductos()">Filtrar</button>
                    <button onclick="limpiarFiltros()">Limpiar</button>
                </div>
            </div>
        </section>

        <section id="productos" class="section">
            <div class="container">
                <div class="section-header">
                    <h3>Catálogo de Productos</h3>
                    <button onclick="exportarProductos()" class="btn-export">
                        📊 Exportar CSV
                    </button>
                </div>
                <div id="productosGrid" class="productos-grid">
                    <div class="loading">Cargando productos...</div>
                </div>
            </div>
        </section>

        <section id="agregar" class="section">
            <div class="container">
                <h3>Agregar Nuevo Producto</h3>
                <form id="productoForm" class="producto-form">
                    <div class="form-group">
                        <label for="nombre">Nombre del Producto:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoría:</label>
                        <select id="categoria" name="categoria" required>
                            <option value="">Seleccionar categoría</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio (COP):</label>
                        <input type="number" id="precio" name="precio" step="100" min="0" required placeholder="Ej: 1500000">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="marca">Marca:</label>
                        <input type="text" id="marca" name="marca">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock:</label>
                        <input type="number" id="stock" name="stock" min="0" value="0">
                    </div>
                    <div class="form-group">
                        <label for="imagen_url">URL de Imagen:</label>
                        <input type="url" id="imagen_url" name="imagen_url" placeholder="https://ejemplo.com/imagen.jpg">
                    </div>
                    <button type="submit">Agregar Producto</button>
                </form>
            </div>
        </section>

        <section id="categorias" class="section">
            <div class="container">
                <div class="section-header">
                    <h3>Gestión de Categorías</h3>
                    <button onclick="exportarCategorias()" class="btn-export">
                        📊 Exportar CSV
                    </button>
                </div>
                <div class="categorias-container">
                    <div class="categorias-form">
                        <h4>Agregar Nueva Categoría</h4>
                        <form id="categoriaForm">
                            <div class="form-group">
                                <label for="categoriaNombre">Nombre:</label>
                                <input type="text" id="categoriaNombre" required>
                            </div>
                            <div class="form-group">
                                <label for="categoriaDescripcion">Descripción:</label>
                                <textarea id="categoriaDescripcion" rows="2"></textarea>
                            </div>
                            <button type="submit">Agregar Categoría</button>
                        </form>
                    </div>
                    <div id="categoriasLista" class="categorias-lista">
                        <div class="loading">Cargando categorías...</div>
                    </div>
                </div>
            </div>
        </section>

        <section id="estadisticas" class="section">
            <div class="container">
                <h3>Estadísticas del Sistema</h3>
                <div id="estadisticasGrid" class="estadisticas-grid">
                    <?php
                    try {
                        require_once 'config/database.php';
                        $database = new Database();
                        $db = $database->getConnection();

                        // Total de productos
                        $stmt = $db->query("SELECT COUNT(*) as total FROM productos");
                        $totalProductos = $stmt->fetchColumn();

                        // Total de stock
                        $stmt = $db->query("SELECT SUM(stock) as total FROM productos");
                        $totalStock = $stmt->fetchColumn() ?: 0;

                        // Productos por categoría
                        $stmt = $db->query("SELECT categoria, COUNT(*) as cantidad FROM productos GROUP BY categoria ORDER BY cantidad DESC");
                        $productosPorCategoria = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Valor total del inventario
                        $stmt = $db->query("SELECT SUM(precio * stock) as valor FROM productos");
                        $valorInventario = $stmt->fetchColumn() ?: 0;
                    ?>
                        <div class="stat-card">
                            <div class="stat-number"><?php echo $totalProductos; ?></div>
                            <div class="stat-label">Total Productos</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number"><?php echo $totalStock; ?></div>
                            <div class="stat-label">Total Stock</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">$<?php echo number_format($valorInventario, 0); ?></div>
                            <div class="stat-label">Valor Inventario</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number"><?php echo count($productosPorCategoria); ?></div>
                            <div class="stat-label">Categorías</div>
                        </div>
                    <?php
                    } catch (Exception $e) {
                        echo '<div class="error-message">Error al cargar estadísticas: ' . $e->getMessage() . '</div>';
                    }
                    ?>
                </div>

                <?php if (isset($productosPorCategoria) && !empty($productosPorCategoria)): ?>
                <div class="categoria-stats">
                    <h4>Productos por Categoría</h4>
                    <div class="categoria-chart">
                        <?php foreach ($productosPorCategoria as $categoria): ?>
                        <div class="categoria-bar">
                            <span class="categoria-name"><?php echo htmlspecialchars($categoria['categoria']); ?></span>
                            <div class="bar-container">
                                <div class="bar" style="width: <?php echo ($categoria['cantidad'] / $totalProductos) * 100; ?>%"></div>
                                <span class="bar-value"><?php echo $categoria['cantidad']; ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 TechStore - Sistema de Gestión Tecnológica desarrollado en PHP</p>
        </div>
    </footer>

    <script src="static/js/script.js"></script>
</body>
</html>