# 🪟 **GUÍA DE INSTALACIÓN - WINDOWS**
## TechStore - Sistema de Gestión de Productos Tecnológicos

---

## 📋 **PRERREQUISITOS**

### **Sistema Operativo**
- ✅ **Windows 10** (versión 1903 o superior)
- ✅ **Windows 11** (recomendado)
- ✅ **PowerShell** o **Command Prompt** (incluido en Windows)
- ✅ **Navegador web** (Edge, Chrome, Firefox)

### **Permisos**
- 🔑 **Cuenta de Administrador** (para instalar software)

---

## 🚀 **INSTALACIÓN PASO A PASO**

### **PASO 1: Instalar Chocolatey (Gestor de Paquetes)**

**¿Qué es Chocolatey?** Es como "un App Store" para programas de Windows.

1. **Abrir PowerShell como Administrador:**
   - Presionar `Win + X`
   - Seleccionar "Windows PowerShell (Administrador)" o "Terminal (Administrador)"

2. **Ejecutar comando de instalación:**
```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))
```

3. **Verificar instalación:**
```powershell
choco --version
```

**Deberías ver:** `2.x.x`

### **MÉTODO ALTERNATIVO: Sin Chocolatey (Descarga Manual)**

Si prefieres no usar Chocolatey:

1. **Ir a:** https://windows.php.net/download
2. **Descargar:** "Thread Safe" ZIP para tu arquitectura (x64 recomendado)
3. **Extraer** en `C:\php`
4. **Agregar a PATH:**
   - `Win + R`, escribir `sysdm.cpl`
   - Pestaña "Opciones avanzadas" → "Variables de entorno"
   - En "Variables del sistema", buscar "Path" → "Editar"
   - "Nuevo" → `C:\php`

### **PASO 2: Instalar PHP**

#### **Con Chocolatey (Recomendado):**
```powershell
# Instalar PHP
choco install php

# Verificar instalación
php --version
```

#### **Configuración Adicional (Si es necesario):**
```powershell
# Habilitar extensiones necesarias
# Editar C:\tools\php84\php.ini (o similar)
# Descomentar estas líneas:
# extension=sqlite3
# extension=pdo_sqlite
```

### **PASO 3: Descargar el Proyecto**

#### **Opción A: Con Git**
```powershell
# Si tienes Git instalado
git clone https://github.com/nkescobar/tech_store_app.git
cd tech_store_app
```

#### **Opción B: Descarga Manual**
1. **Descargar** el archivo ZIP del proyecto
2. **Extraer** en el Escritorio o carpeta de preferencia
3. **Renombrar** la carpeta a `tech_store_app`
4. **Navegar** en PowerShell:
```powershell
cd C:\Users\[TU-USUARIO]\Desktop\tech_store_app
# Reemplazar [TU-USUARIO] con tu nombre de usuario
```

### **PASO 4: Verificar Estructura del Proyecto**

```powershell
dir
```

**Deberías ver:**
```
Directory: C:\...\tech_store_app

    api\
    config\
    css\
    js\
    index.php
    README.md
    INSTALL_WINDOWS.bat
```

### **PASO 5: Ejecutar la Aplicación**

#### **Método 1: Script Automático (Súper Fácil)**
1. **Doble clic** en `INSTALL_WINDOWS.bat`
2. **¡Listo!** Se abrirá automáticamente

#### **Método 2: PowerShell/CMD**
```powershell
# En la carpeta del proyecto
php -S localhost:8000
```

#### **Método 3: Con verificación completa**
```powershell
# Ejecutar el script desde PowerShell
.\INSTALL_WINDOWS.bat
```

### **PASO 6: Acceder a la Aplicación**

1. **Abrir navegador**
2. **Ir a:** `http://localhost:8000`
3. **¡Funciona!** La aplicación carga con productos de ejemplo

---

## 🔧 **COMANDOS ÚTILES PARA WINDOWS**

### **PowerShell Básico**
```powershell
# Ver archivos en carpeta actual
dir
# o
ls

# Navegar a carpeta
cd C:\ruta\a\carpeta

# Limpiar pantalla
clear
# o
cls

# Ver contenido de archivo
Get-Content index.php

# Abrir explorador de archivos en carpeta actual
explorer .
```

### **Gestión del Servidor PHP**
```powershell
# Iniciar servidor
php -S localhost:8000

# Iniciar en otro puerto
php -S localhost:8080

# Ver qué proceso usa un puerto
netstat -ano | findstr :8000

# Matar proceso por PID
taskkill /PID [número] /F
```

### **Gestión de Archivos**
```powershell
# Ver archivos ocultos
dir -Force

# Crear directorio
mkdir database

# Copiar archivo
copy archivo.txt destino.txt

# Eliminar archivo
del archivo.txt
```

---

## 🛠️ **TROUBLESHOOTING ESPECÍFICO PARA WINDOWS**

### **❌ Error: "'php' is not recognized"**

#### **Solución 1: Reinstalar con Chocolatey**
```powershell
# Como Administrador
choco install php --force
```

#### **Solución 2: Agregar PHP al PATH manualmente**
```powershell
# Encontrar dónde está PHP
where php

# Si no encuentra, agregar al PATH:
# Win + R → sysdm.cpl → Variables de entorno
# Agregar: C:\tools\php84 (o donde esté instalado)
```

#### **Solución 3: Usar ruta completa**
```powershell
# Si PHP está en C:\tools\php84
C:\tools\php84\php.exe -S localhost:8000
```

### **❌ Error: "Access Denied" al instalar**
```powershell
# Ejecutar PowerShell como Administrador
# Win + X → "Terminal (Administrador)"

# O cambiar política de ejecución
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

### **❌ Error: "Port 8000 is already in use"**
```powershell
# Ver qué usa el puerto 8000
netstat -ano | findstr :8000

# Resultado ejemplo: TCP 127.0.0.1:8000 0.0.0.0:0 LISTENING 1234
# Matar proceso con PID 1234
taskkill /PID 1234 /F

# O usar otro puerto
php -S localhost:8080
```

### **❌ Error: "SSL certificate problem"**
```powershell
# Descargar certificado SSL para Windows
# En php.ini, configurar:
curl.cainfo = "C:\tools\php84\cacert.pem"

# Descargar cacert.pem desde:
# https://curl.se/ca/cacert.pem
```

### **❌ Error: "Class 'SQLite3' not found"**
1. **Encontrar php.ini:**
```powershell
php --ini
```

2. **Editar php.ini (como Administrador):**
```ini
# Descomentar estas líneas:
extension=sqlite3
extension=pdo_sqlite
```

3. **Reiniciar servidor PHP**

---

## 🚀 **OPTIMIZACIONES PARA WINDOWS**

### **Windows Terminal (Recomendado)**
```powershell
# Instalar Windows Terminal desde Microsoft Store
# O con Chocolatey:
choco install microsoft-windows-terminal
```

### **Configurar Variables de Entorno Permanentes**
```powershell
# Crear variable TECHSTORE_PATH
[Environment]::SetEnvironmentVariable("TECHSTORE_PATH", "C:\Users\[TU-USUARIO]\tech_store_app", "User")

# Crear alias temporal (en sesión actual)
Set-Alias techstore "C:\Users\[TU-USUARIO]\tech_store_app\INSTALL_WINDOWS.bat"
```

### **Script de Inicio Automático**
Crear `start_techstore.ps1`:
```powershell
# Contenido del archivo:
Set-Location "C:\Users\$env:USERNAME\tech_store_app"
Write-Host "=== TechStore iniciando ===" -ForegroundColor Green
php -S localhost:8000
```

### **Tarea Programada**
```powershell
# Crear tarea que inicie TechStore automáticamente
schtasks /create /sc onstart /tn "TechStore" /tr "powershell.exe -File C:\ruta\start_techstore.ps1"
```

---

## 🔄 **ACTUALIZACIONES EN WINDOWS**

### **Actualizar PHP**
```powershell
# Con Chocolatey
choco upgrade php

# Verificar nueva versión
php --version
```

### **Actualizar Chocolatey**
```powershell
choco upgrade chocolatey
```

### **Actualizar Proyecto**
```powershell
# Si usas Git
git pull origin main

# Si descargaste manualmente, reemplazar archivos
# CUIDADO: mantener carpeta database\ intacta
```

---

## 📊 **MONITOREO Y DEBUG EN WINDOWS**

### **Ver Logs con PowerShell**
```powershell
# Ejecutar servidor con logs visibles
php -S localhost:8000 2>&1 | Tee-Object -FilePath "server.log"

# Ver log en tiempo real
Get-Content "server.log" -Wait -Tail 10
```

### **Verificar APIs con PowerShell**
```powershell
# Probar API de productos
Invoke-WebRequest -Uri "http://localhost:8000/api/productos.php" | Select-Object Content

# Probar con formato JSON
$response = Invoke-RestMethod -Uri "http://localhost:8000/api/productos.php"
$response | ConvertTo-Json -Depth 3
```

### **Monitoreo de Rendimiento**
```powershell
# Ver uso de CPU y memoria de PHP
Get-Process php | Select-Object ProcessName,CPU,WorkingSet

# Monitor continuo
while($true) {
    Get-Process php | Select-Object ProcessName,CPU,WorkingSet;
    Start-Sleep 5;
    Clear-Host
}
```

---

## 🎯 **INTEGRACIÓN CON HERRAMIENTAS WINDOWS**

### **Visual Studio Code**
```powershell
# Instalar VS Code
choco install vscode

# Abrir proyecto en VS Code
code .

# Extensiones recomendadas para PHP:
# - PHP Extension Pack
# - SQLite Viewer
```

### **Navegadores para Desarrollo**
```powershell
# Chrome con herramientas de desarrollo
# F12 para abrir DevTools
# Network tab para debug de APIs

# Edge DevTools (similar a Chrome)
# Firefox Developer Tools
```

### **📊 Base de Datos del Proyecto**
```powershell
# 🚨 IMPORTANTE: Este proyecto usa MYSQL como base de datos principal
# SQLite solo se usa automáticamente para desarrollo local cuando MySQL no está disponible

# Ver archivos de base de datos local
dir database\

# Si quieres consultar la base de datos local de desarrollo (opcional):
choco install sqlite
sqlite3 database\techstore.db

# 🔧 OPCIONAL: Instalar MySQL localmente (no requerido para el taller)
# Solo si quieres usar MySQL en desarrollo local también
choco install mysql
# Seguir instrucciones de configuración de MySQL
```

---

## 🔒 **SEGURIDAD Y FIREWALL**

### **Configurar Firewall de Windows**
```powershell
# Permitir PHP en firewall (como Administrador)
New-NetFirewallRule -DisplayName "PHP Development Server" -Direction Inbound -Port 8000 -Protocol TCP -Action Allow

# Ver reglas activas
Get-NetFirewallRule | Where-Object DisplayName -like "*PHP*"
```

### **Windows Defender**
- **Agregar excepción** para la carpeta del proyecto
- **Configuración** → Virus y amenazas → Exclusiones → Agregar carpeta

---

## ✅ **VERIFICACIÓN FINAL WINDOWS**

### **Checklist Completo**
- [ ] **PowerShell/CMD** funciona
- [ ] **PHP** instalado (`php --version`)
- [ ] **Chocolatey** funciona (`choco --version`)
- [ ] **Proyecto** descargado en carpeta correcta
- [ ] **Puerto 8000** libre (`netstat -ano | findstr :8000`)
- [ ] **Servidor** inicia (`php -S localhost:8000`)
- [ ] **Navegador** abre http://localhost:8000
- [ ] **Productos** cargan con imágenes
- [ ] **Base de datos** se crea en `database\techstore.db`
- [ ] **Funciones** CRUD funcionan
- [ ] **APIs** responden correctamente

### **Script de Verificación Automática**
Crear `verificar.bat`:
```batch
@echo off
echo === VERIFICACION TECHSTORE WINDOWS ===
echo.

echo [1] PHP Version:
php --version
echo.

echo [2] Estructura del proyecto:
if exist "index.php" (echo ✓ index.php encontrado) else (echo ✗ index.php NO encontrado)
if exist "api" (echo ✓ carpeta api encontrada) else (echo ✗ carpeta api NO encontrada)
echo.

echo [3] Puerto 8000:
netstat -ano | findstr :8000 > nul
if %errorlevel% equ 0 (echo ⚠ Puerto 8000 ocupado) else (echo ✓ Puerto 8000 libre)
echo.

echo === LISTO PARA INICIAR ===
pause
```

---

## 🆘 **SOPORTE ESPECÍFICO WINDOWS**

### **Recursos Windows**
- 🍫 **Chocolatey Docs:** https://docs.chocolatey.org
- 🔧 **PHP Windows:** https://windows.php.net
- 💻 **PowerShell Guide:** https://docs.microsoft.com/powershell

### **Comandos de Emergencia**
```powershell
# Reset completo PHP
choco uninstall php
choco install php

# Reparar Chocolatey
choco repair

# Verificar integridad del sistema
sfc /scannow
```

---

## 🎮 **ATAJOS DE TECLADO ÚTILES**

| Acción | Atajo | Descripción |
|--------|-------|-------------|
| **Abrir Terminal** | `Win + X, A` | PowerShell como Admin |
| **Ejecutar Comando** | `Win + R` | Ventana "Ejecutar" |
| **Explorador Archivos** | `Win + E` | Abrir explorador |
| **Buscar** | `Win + S` | Buscar archivos/apps |
| **DevTools** | `F12` | En navegador |
| **Refrescar** | `Ctrl + F5` | Recarga completa |

---

**🎉 ¡TechStore funcionando perfectamente en Windows!**

*Última actualización: Septiembre 2024*
*Versión: Windows 1.0.0*