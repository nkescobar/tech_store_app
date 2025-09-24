# 🐧 **GUÍA DE INSTALACIÓN - LINUX**
## TechStore - Sistema de Gestión de Productos Tecnológicos

---

## 📋 **PRERREQUISITOS**

### **Distribuciones Soportadas**
- ✅ **Ubuntu 20.04+** / **Debian 11+**
- ✅ **CentOS 8+** / **RHEL 8+** / **Fedora 34+**
- ✅ **Arch Linux** / **Manjaro**
- ✅ **openSUSE Leap 15.3+**

### **Herramientas Básicas**
- 🔧 **Terminal** (bash, zsh, fish)
- 🌐 **Navegador web** (Firefox, Chrome, Chromium)
- 📦 **Gestor de paquetes** (apt, yum, dnf, pacman, zypper)

---

## 🚀 **INSTALACIÓN POR DISTRIBUCIÓN**

### **📦 UBUNTU / DEBIAN**

#### **PASO 1: Actualizar Sistema**
```bash
# Actualizar lista de paquetes
sudo apt update

# Actualizar sistema (opcional pero recomendado)
sudo apt upgrade -y
```

#### **PASO 2: Instalar PHP y Extensiones**
```bash
# Instalar PHP con extensiones necesarias
# NOTA: Este proyecto usa MySQL como BD principal, SQLite solo para desarrollo local
sudo apt install -y php php-cli php-mysql php-sqlite3 php-json php-mbstring php-curl php-zip

# Verificar instalación
php --version
```

#### **PASO 3: Instalar herramientas adicionales (opcional)**
```bash
# Git para clonar el repositorio
sudo apt install -y git curl wget

# 📊 IMPORTANTE: Base de Datos del Proyecto
# Este proyecto usa MYSQL como base de datos principal para el taller
# SQLite solo se usa automáticamente para desarrollo local

# SQLite3 para explorar la base de datos local de desarrollo (opcional)
sudo apt install -y sqlite3

# MySQL para base de datos principal (opcional para desarrollo local)
sudo apt install -y mysql-server

# Nano/vim para editar archivos
sudo apt install -y nano
```

---

### **🎩 CENTOS / RHEL / FEDORA**

#### **PASO 1: Habilitar Repositorios**
```bash
# Para CentOS/RHEL 8+
sudo dnf install -y epel-release
sudo dnf module enable php:8.1

# Para Fedora (más reciente)
sudo dnf update -y
```

#### **PASO 2: Instalar PHP**
```bash
# CentOS/RHEL
# NOTA: Este proyecto usa MySQL como BD principal
sudo dnf install -y php php-cli php-pdo php-mysql php-sqlite3 php-json php-mbstring

# Fedora
sudo dnf install -y php php-cli php-mysql php-sqlite3 php-json php-mbstring php-curl

# Verificar
php --version
```

#### **PASO 3: Herramientas adicionales**
```bash
sudo dnf install -y git curl wget sqlite nano
```

---

### **⚡ ARCH LINUX / MANJARO**

#### **PASO 1: Actualizar Sistema**
```bash
# Actualizar sistema completo
sudo pacman -Syu
```

#### **PASO 2: Instalar PHP**
```bash
# Instalar PHP y extensiones
sudo pacman -S php php-sqlite

# Habilitar extensiones en php.ini
sudo nano /etc/php/php.ini

# Descomentar estas líneas:
# extension=pdo_sqlite
# extension=sqlite3
```

#### **PASO 3: Herramientas adicionales**
```bash
sudo pacman -S git curl wget sqlite nano
```

---

### **🦎 openSUSE**

#### **PASO 1: Actualizar**
```bash
sudo zypper refresh
sudo zypper update
```

#### **PASO 2: Instalar PHP**
```bash
# Instalar PHP y extensiones
sudo zypper install php8 php8-sqlite php8-json php8-mbstring php8-curl

# Verificar
php --version
```

#### **PASO 3: Herramientas adicionales**
```bash
sudo zypper install git curl wget sqlite3 nano
```

---

## 📁 **DESCARGAR Y CONFIGURAR PROYECTO**

### **PASO 1: Clonar Repositorio**
```bash
# Navegar al directorio home
cd ~

# Clonar el repositorio
git clone https://github.com/nkescobar/tech_store_app.git

# Navegar al proyecto
cd tech_store_app
```

### **PASO 2: Verificar Estructura**
```bash
ls -la
```

**Deberías ver:**
```
drwxr-xr-x   api/
drwxr-xr-x   config/
drwxr-xr-x   css/
drwxr-xr-x   js/
-rw-r--r--   index.php
-rw-r--r--   README.md
-rwxr-xr-x   install_mac.sh
```

### **PASO 3: Dar Permisos**
```bash
# Dar permisos de ejecución al script
chmod +x install_mac.sh

# Crear directorio para base de datos si no existe
mkdir -p database

# Dar permisos de escritura
chmod 755 database
```

---

## 🚀 **EJECUTAR LA APLICACIÓN**

### **Método 1: Script Automático**
```bash
# Ejecutar script de instalación
./install_mac.sh
```

### **Método 2: Manual**
```bash
# Iniciar servidor PHP
php -S localhost:8000

# En otra terminal, verificar que funciona
curl http://localhost:8000
```

### **Método 3: Con nohup (mantener en background)**
```bash
# Iniciar en background
nohup php -S localhost:8000 > server.log 2>&1 &

# Ver el PID del proceso
echo $!

# Ver logs en tiempo real
tail -f server.log
```

---

## 🔧 **COMANDOS ÚTILES PARA LINUX**

### **Gestión de Procesos**
```bash
# Ver procesos PHP
ps aux | grep php

# Matar proceso por puerto
sudo lsof -ti:8000 | xargs kill -9

# Ver qué usa un puerto
netstat -tulpn | grep :8000
# o con ss (más moderno)
ss -tulpn | grep :8000
```

### **Gestión de Archivos**
```bash
# Permisos completos
chmod -R 755 tech_store_app/

# Cambiar propietario
sudo chown -R $USER:$USER tech_store_app/

# Ver espacio en disco
df -h

# Ver uso de memoria
free -h
```

### **Monitoreo del Sistema**
```bash
# Monitor de recursos en tiempo real
top
# o mejor
htop

# Ver logs del sistema
journalctl -f

# Ver uso de red
iftop
# o
nethogs
```

---

## 🛠️ **TROUBLESHOOTING LINUX**

### **❌ Error: "php: command not found"**
```bash
# Verificar si está instalado
which php

# Ubuntu/Debian
sudo apt install php php-cli

# CentOS/RHEL/Fedora
sudo dnf install php php-cli

# Arch/Manjaro
sudo pacman -S php

# openSUSE
sudo zypper install php8
```

### **❌ Error: "Class 'SQLite3' not found"**
```bash
# Verificar módulos PHP instalados
php -m | grep -i sqlite

# Si no aparece, instalar:

# Ubuntu/Debian
sudo apt install php-sqlite3

# CentOS/RHEL/Fedora
sudo dnf install php-sqlite3

# Arch/Manjaro
sudo pacman -S php-sqlite
# Y habilitar en /etc/php/php.ini:
# extension=sqlite3
# extension=pdo_sqlite
```

### **❌ Error: "Permission denied"**
```bash
# Dar permisos al directorio
chmod -R 755 tech_store_app/

# Cambiar propietario
sudo chown -R $USER:$USER tech_store_app/

# Para el script
chmod +x install_mac.sh
```

### **❌ Error: "Address already in use"**
```bash
# Ver qué proceso usa el puerto 8000
sudo lsof -i :8000

# Matar proceso
sudo kill -9 [PID]

# O usar otro puerto
php -S localhost:8080
```

### **❌ Error: "No space left on device"**
```bash
# Ver espacio disponible
df -h

# Limpiar cache del sistema
# Ubuntu/Debian
sudo apt autoremove
sudo apt autoclean

# Fedora
sudo dnf autoremove
sudo dnf clean all
```

---

## 🔒 **SEGURIDAD Y FIREWALL**

### **Configurar UFW (Ubuntu/Debian)**
```bash
# Instalar UFW si no está
sudo apt install ufw

# Permitir puerto 8000 (solo desde localhost)
sudo ufw allow from 127.0.0.1 to any port 8000

# Ver estado
sudo ufw status
```

### **Configurar firewalld (CentOS/RHEL/Fedora)**
```bash
# Permitir puerto temporalmente
sudo firewall-cmd --add-port=8000/tcp

# Permanentemente
sudo firewall-cmd --permanent --add-port=8000/tcp
sudo firewall-cmd --reload
```

### **Configurar iptables (Manual)**
```bash
# Permitir puerto 8000 desde localhost
sudo iptables -A INPUT -s 127.0.0.1 -p tcp --dport 8000 -j ACCEPT

# Guardar reglas (Ubuntu/Debian)
sudo iptables-save > /etc/iptables/rules.v4
```

---

## 📊 **MONITOREO Y LOGS**

### **Logs del Sistema**
```bash
# Ver logs de PHP
sudo tail -f /var/log/php_errors.log

# Logs generales del sistema
sudo journalctl -f

# Logs específicos de la aplicación
tail -f server.log
```

### **Monitoreo de Rendimiento**
```bash
# CPU y memoria
htop

# Uso de red
iftop

# Disk I/O
iotop

# Todo en uno
glances
```

### **Verificar APIs**
```bash
# Probar endpoints con curl
curl -s http://localhost:8000/api/productos.php | head -200

# Con formato JSON legible
curl -s http://localhost:8000/api/productos.php | python3 -m json.tool

# Headers de respuesta
curl -I http://localhost:8000/api/productos.php
```

---

## 🚀 **OPTIMIZACIONES PARA LINUX**

### **Configuración de PHP**
```bash
# Encontrar php.ini
php --ini

# Optimizaciones recomendadas para desarrollo:
# memory_limit = 256M
# max_execution_time = 60
# max_input_time = 60
# post_max_size = 64M
# upload_max_filesize = 64M
```

### **Servicio Systemd (Opcional)**
Crear `/etc/systemd/system/techstore.service`:
```ini
[Unit]
Description=TechStore PHP Server
After=network.target

[Service]
Type=simple
User=tu-usuario
WorkingDirectory=/home/tu-usuario/tech_store_app
ExecStart=/usr/bin/php -S localhost:8000
Restart=always
RestartSec=3

[Install]
WantedBy=multi-user.target
```

```bash
# Habilitar y iniciar servicio
sudo systemctl enable techstore
sudo systemctl start techstore

# Ver estado
sudo systemctl status techstore
```

### **Script de Inicio Automático**
Agregar a `~/.bashrc` o `~/.zshrc`:
```bash
# Alias para TechStore
alias techstore='cd ~/tech_store_app && php -S localhost:8000'
alias techstore-bg='cd ~/tech_store_app && nohup php -S localhost:8000 > server.log 2>&1 &'

# Función para verificar TechStore
techstore-check() {
    curl -s http://localhost:8000/api/productos.php > /dev/null
    if [ $? -eq 0 ]; then
        echo "✅ TechStore funcionando en http://localhost:8000"
    else
        echo "❌ TechStore no responde"
    fi
}
```

---

## 🔄 **ACTUALIZACIONES**

### **Actualizar Sistema**
```bash
# Ubuntu/Debian
sudo apt update && sudo apt upgrade

# CentOS/RHEL/Fedora
sudo dnf update

# Arch/Manjaro
sudo pacman -Syu

# openSUSE
sudo zypper update
```

### **Actualizar Proyecto**
```bash
# Con Git
cd ~/tech_store_app
git pull origin main

# Verificar cambios
git log --oneline -5
```

### **Backup de Base de Datos**
```bash
# Crear backup
cp database/techstore.db database/techstore.db.backup.$(date +%Y%m%d_%H%M%S)

# Restaurar backup
cp database/techstore.db.backup.20240923_120000 database/techstore.db
```

---

## 🐧 **DISTRIBUCIONES ESPECÍFICAS**

### **Ubuntu Server (Sin GUI)**
```bash
# Instalar navegador de texto para testing
sudo apt install lynx

# Probar la aplicación
lynx http://localhost:8000

# O usar curl para todas las pruebas
curl -s http://localhost:8000 | grep "TechStore"
```

### **Raspberry Pi (Raspbian)**
```bash
# Instalación específica
sudo apt update
sudo apt install php php-cli php-sqlite3 php-json php-mbstring

# Puede ser más lento, usar puerto específico
php -S 0.0.0.0:8000  # Accesible desde red local
```

### **Docker (Cualquier distribución)**
```dockerfile
# Dockerfile
FROM php:8.2-cli

WORKDIR /app
COPY . /app

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000"]
```

```bash
# Construir y ejecutar
docker build -t techstore .
docker run -p 8000:8000 techstore
```

---

## ✅ **VERIFICACIÓN FINAL LINUX**

### **Script de Verificación Completa**
```bash
#!/bin/bash
echo "=== VERIFICACIÓN TECHSTORE LINUX ==="
echo

# Verificar PHP
if command -v php &> /dev/null; then
    echo "✅ PHP: $(php --version | head -1)"
else
    echo "❌ PHP no encontrado"
    exit 1
fi

# Verificar extensiones
php -m | grep -i sqlite > /dev/null && echo "✅ SQLite: OK" || echo "❌ SQLite: NO"
php -m | grep -i json > /dev/null && echo "✅ JSON: OK" || echo "❌ JSON: NO"

# Verificar estructura del proyecto
[ -f "index.php" ] && echo "✅ index.php: OK" || echo "❌ index.php: NO"
[ -d "api" ] && echo "✅ Directorio api: OK" || echo "❌ Directorio api: NO"

# Verificar puerto
if ss -tulpn | grep :8000 > /dev/null; then
    echo "⚠️  Puerto 8000: OCUPADO"
else
    echo "✅ Puerto 8000: LIBRE"
fi

# Verificar permisos
[ -x "install_mac.sh" ] && echo "✅ Script ejecutable: OK" || echo "❌ Script ejecutable: NO"

echo
echo "=== LISTO PARA INICIAR ==="
```

### **Checklist Manual**
- [ ] **Distribución** soportada
- [ ] **PHP 8.0+** instalado
- [ ] **Extensión SQLite** habilitada
- [ ] **Git** instalado para actualizaciones
- [ ] **Proyecto** clonado en ~/tech_store_app
- [ ] **Permisos** correctos (755)
- [ ] **Puerto 8000** libre
- [ ] **Navegador** disponible
- [ ] **Base de datos** se crea automáticamente

---

## 🆘 **SOPORTE LINUX**

### **Recursos Específicos**
- 📖 **PHP Linux:** https://www.php.net/manual/en/install.unix.php
- 🐧 **Ubuntu Server:** https://ubuntu.com/server/docs
- 🎩 **CentOS/RHEL:** https://docs.centos.org
- ⚡ **Arch Wiki:** https://wiki.archlinux.org/title/PHP

### **Comandos de Diagnóstico**
```bash
# Información del sistema
uname -a
lsb_release -a  # Ubuntu/Debian
cat /etc/os-release  # General

# Información PHP
php --version
php -m
php --ini

# Red y puertos
netstat -tulpn | grep :8000
ss -tulpn | grep :8000
curl -I http://localhost:8000
```

### **Logs de Diagnóstico**
```bash
# Crear reporte automático
echo "=== REPORTE DIAGNÓSTICO ===" > diagnostico.txt
echo "Fecha: $(date)" >> diagnostico.txt
echo "Sistema: $(uname -a)" >> diagnostico.txt
echo "PHP: $(php --version | head -1)" >> diagnostico.txt
echo "Módulos: $(php -m | tr '\n' ' ')" >> diagnostico.txt
echo "Puerto 8000: $(ss -tulpn | grep :8000)" >> diagnostico.txt
echo "Estructura: $(ls -la | head -10)" >> diagnostico.txt
```

---

**🎉 ¡TechStore funcionando perfectamente en Linux!**

*Última actualización: Septiembre 2024*
*Versión: Linux 1.0.0*