<?php
require_once 'config/database.php';
require_once 'config/session.php';

// Si ya está logueado, redirigir al index
if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        // Buscar usuario por username o email
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE (username = :username OR email = :username) AND activo = TRUE");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar contraseña
            if (password_verify($password, $user['password_hash'])) {
                // Login exitoso
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_username'] = $user['username'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_nombre'] = $user['nombre_completo'];
                $_SESSION['user_rol'] = $user['rol'];
                $_SESSION['login_time'] = time();
                
                // Redirigir al index
                header('Location: index.php');
                exit();
            } else {
                $error = 'Credenciales incorrectas';
            }
        } else {
            $error = 'Usuario no encontrado';
        }
    } catch (Exception $e) {
        $error = 'Error en el sistema: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore - Iniciar Sesión</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .login-form .form-group {
            margin-bottom: 15px;
        }
        
        .login-form label {
            display: block;
            margin-bottom: 5px;
        }
        
        .login-form input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .login-form button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .error-message {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .login-links {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <h1 class="nav-logo">🖥️ TechStore</h1>
            </div>
        </nav>
    </header>

    <main>
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form class="login-form" method="POST" action="login.php">
                <div class="form-group">
                    <label for="username">Usuario o Email:</label>
                    <input type="text" id="username" name="username" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit">Iniciar Sesión</button>
            </form>
            
            <div class="login-links">
                <p>Usuario demo: <strong>admin</strong> / Contraseña: <strong>admin123</strong></p>
            </div>
        </div>
    </main>
</body>
</html>
