#!/bin/bash

echo "========================================"
echo "   TECHSTORE - INSTALACIÓN macOS/Linux"
echo "========================================"
echo

# Verificar PHP
echo "[1/3] Verificando PHP..."
if ! command -v php &> /dev/null; then
    echo "ERROR: PHP no está instalado"
    echo
    echo "Para macOS:"
    echo "  brew install php"
    echo
    echo "Para Linux Ubuntu/Debian:"
    echo "  sudo apt update"
    echo "  sudo apt install php php-sqlite3"
    echo
    exit 1
fi

echo "PHP encontrado!"
php --version
echo

# Verificar estructura del proyecto
echo "[2/3] Verificando estructura del proyecto..."
if [ ! -f "index.php" ]; then
    echo "ERROR: No estás en la carpeta correcta del proyecto"
    echo "Asegúrate de estar en la carpeta 'web' que contiene index.php"
    exit 1
fi

echo "Estructura del proyecto OK!"
echo

# Crear directorio de base de datos si no existe
if [ ! -d "database" ]; then
    mkdir database
    echo "Directorio database creado"
fi

echo "[3/3] Iniciando servidor PHP..."
echo
echo "========================================"
echo "  SERVIDOR INICIADO EN:"
echo "  http://localhost:8000"
echo "========================================"
echo
echo "Presiona Ctrl+C para detener el servidor"
echo

php -S localhost:8000