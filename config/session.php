<?php
session_start();

// Configuración de seguridad para sesiones
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);

// Regenerar ID de sesión periódicamente para mayor seguridad
if (!isset($_SESSION['last_regeneration'])) {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
} elseif (time() - $_SESSION['last_regeneration'] > 1800) { // 30 minutos
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}

// Función para verificar si el usuario está logueado
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Función para verificar si el usuario es administrador
function isAdmin() {
    return isLoggedIn() && isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin';
}

// Función para requerir login
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

// Función para requerir rol de administrador
function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        header('Location: index.php');
        exit();
    }
}
?>
