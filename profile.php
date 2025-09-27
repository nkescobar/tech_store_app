<?php
require_once 'config/session.php';
requireLogin();

// Obtener información actualizada del usuario desde la BD
try {
    require_once 'config/database.php';
    $database = new Database();
    $db = $database->getConnection();

    $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header('Location: logout.php');
        exit();
    }
} catch (Exception $e) {
    $error = "Error al cargar perfil: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>👤 Mi Perfil - TechStore</title>
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
                            <?php if (isAdmin()): ?>
                            <a href="admin.php">Panel Admin</a>
                            <?php endif; ?>
                            <a href="logout.php">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="section">
            <div class="container">
                <h2>Mi Perfil</h2>

                <?php if (isset($error)): ?>
                    <div class="error-message" style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            👤
                        </div>
                        <h3 class="profile-name"><?php echo htmlspecialchars($user['nombre_completo']); ?></h3>
                        <span class="profile-role">
                            <?php echo $user['rol'] === 'admin' ? 'Administrador' : 'Usuario'; ?>
                        </span>
                    </div>

                    <div class="profile-content">

                <div id="info" class="tab-content active">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-details">
                                <h4>Nombre Completo</h4>
                                <p><?php echo htmlspecialchars($user['nombre_completo']); ?></p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-details">
                                <h4>Nombre de Usuario</h4>
                                <p><?php echo htmlspecialchars($user['username']); ?></p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-details">
                                <h4>Correo Electrónico</h4>
                                <p><?php echo htmlspecialchars($user['email']); ?></p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-details">
                                <h4>Rol en el Sistema</h4>
                                <p><?php echo $user['rol'] === 'admin' ? 'Administrador' : 'Usuario'; ?></p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-details">
                                <h4>Fecha de Registro</h4>
                                <p><?php echo date('d/m/Y H:i', strtotime($user['fecha_creacion'])); ?></p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-details">
                                <h4>Estado de Cuenta</h4>
                                <p><?php echo $user['activo'] ? 'Activa' : 'Inactiva'; ?></p>
                            </div>
                        </div>
                    </div>

                    <button class="btn-edit" onclick="editarPerfil()">Editar Información</button>
                </div>


                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 TechStore - Mi Perfil</p>
        </div>
    </footer>

    <script src="static/js/script.js"></script>
    <script>
        function editarPerfil() {
            alert('Función en desarrollo: Editar Perfil\n\nPróximamente podrás:\n• Cambiar tu nombre\n• Actualizar email\n• Modificar información personal');
        }
    </script>
</body>
</html>
