<?php
require_once 'config/session.php';
requireAdmin(); // Solo administradores pueden acceder
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore - Panel de Administración</title>
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
                    <a href="index.php" class="nav-link">Inicio</a>
                    <a href="index.php#productos" class="nav-link">Productos</a>
                    <a href="index.php#categorias" class="nav-link">Categorías</a>
                    <a href="index.php#estadisticas" class="nav-link">Estadísticas</a>

                    <!-- Menú de usuario -->
                    <div class="user-menu">
                        <span class="user-info">Hola, <?php echo htmlspecialchars($_SESSION['user_nombre']); ?></span>
                        <div class="user-dropdown">
                            <a href="profile.php">Mi Perfil</a>
                            <a href="admin.php">Panel Admin</a>
                            <a href="logout.php">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="admin-header">
        <div class="container">
            <h1>Panel de Administración</h1>
            <p>Gestiona todos los aspectos de TechStore desde aquí</p>
        </div>
    </div>

    <main class="admin-dashboard">
        <div class="container">
            <div class="admin-cards">
                <div class="admin-card">
                    <div class="admin-card-icon">📱</div>
                    <h3>Gestión de Productos</h3>
                    <p>Gestión completa de productos, crear, editar y eliminar productos</p>
                    <a href="index.php#productos" class="admin-btn">Ir a Productos</a>
                </div>

                <div class="admin-card">
                    <div class="admin-card-icon">📂</div>
                    <h3>Gestión de Categorías</h3>
                    <p>Organiza y estructura el catálogo de productos</p>
                    <a href="index.php#categorias" class="admin-btn">Gestionar Categorías</a>
                </div>

                <div class="admin-card">
                    <div class="admin-card-icon">📊</div>
                    <h3>Reportes y Analytics</h3>
                    <p>Visualiza estadísticas detalladas y reportes del sistema</p>
                    <a href="index.php#estadisticas" class="admin-btn">Ver Estadísticas</a>
                </div>
            </div>

            <div class="recent-activity">
                <h3>Resumen del Sistema</h3>

                <?php
                try {
                    require_once 'config/database.php';
                    $database = new Database();
                    $db = $database->getConnection();

                    // Información básica del sistema
                    $stmt = $db->query("SELECT COUNT(*) as total FROM productos");
                    $totalProductos = $stmt->fetchColumn();

                    $stmt = $db->query("SELECT COUNT(*) as total FROM categorias");
                    $totalCategorias = $stmt->fetchColumn();

                    echo '
                    <div class="activity-item">
                        <div class="activity-text">
                            <strong>Total de productos:</strong> ' . $totalProductos . '
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-text">
                            <strong>Total de categorías:</strong> ' . $totalCategorias . '
                        </div>
                    </div>
';

                } catch (Exception $e) {
                    echo '<div class="activity-item">
                        <div class="activity-text">Error al cargar información del sistema</div>
                    </div>';
                }
                ?>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 TechStore - Panel de Administración</p>
        </div>
    </footer>

    <script src="static/js/script.js"></script>
</body>
</html>