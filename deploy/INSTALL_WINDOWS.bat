@echo off
echo ========================================
echo    TECHSTORE - INSTALACION WINDOWS
echo ========================================
echo.

echo [1/3] Verificando PHP...
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: PHP no esta instalado
    echo.
    echo Instala PHP primero:
    echo 1. Descargar desde: https://windows.php.net/download
    echo 2. O usar Chocolatey: choco install php
    echo.
    pause
    exit /b 1
)

echo PHP encontrado!
php --version
echo.

echo [2/3] Verificando estructura del proyecto...
if not exist "index.php" (
    echo ERROR: No estas en la carpeta correcta del proyecto
    echo Asegurate de estar en la carpeta 'web' que contiene index.php
    pause
    exit /b 1
)

echo Estructura del proyecto OK!
echo.

echo [3/3] Iniciando servidor PHP...
echo.
echo ========================================
echo  SERVIDOR INICIADO EN:
echo  http://localhost:8000
echo ========================================
echo.
echo Presiona Ctrl+C para detener el servidor
echo.

php -S localhost:8000