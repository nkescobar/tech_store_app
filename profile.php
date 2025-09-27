<?php
require_once 'config/session.php';
requireLogin();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - TechStore</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <!-- Mismo navbar que index.php -->
    </header>

    <main>
        <section class="section">
            <div class="container">
                <h2>Mi Perfil</h2>
                <div class="profile-info">
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['user_nombre']); ?></p>
                    <p><strong>Usuario:</strong> <?php echo htmlspecialchars($_SESSION['user_username']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
                    <p><strong>Rol:</strong> <?php echo htmlspecialchars($_SESSION['user_rol']); ?></p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
