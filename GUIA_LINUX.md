# 🐧 **GUÍA DE INSTALACIÓN - LINUX**

## 📋 **PRERREQUISITOS**
- Linux (Ubuntu, CentOS, Arch, etc.)
- Terminal

---

## 🚀 **INSTALACIÓN**

### **Ubuntu/Debian**
```bash
# Instalar PHP
sudo apt update
sudo apt install php php-mysql php-sqlite3 php-json php-mbstring

# Verificar
php --version
```

### **CentOS/RHEL/Fedora**
```bash
# CentOS/RHEL
sudo dnf install php php-mysql php-sqlite3 php-json php-mbstring

# Verificar
php --version
```

### **Arch/Manjaro**
```bash
sudo pacman -S php php-sqlite
```

### **OpenSUSE**
```bash
sudo zypper install php8 php8-mysql php8-sqlite
```

---

## 🚀 **USAR LA APLICACIÓN**

### **Descargar Proyecto**
```bash
git clone https://github.com/nkescobar/tech_store_app.git
cd tech_store_app
```

### **Ejecutar**
```bash
php -S localhost:8000
```

### **Abrir navegador**
http://localhost:8000

---

## 📊 **BASE DE DATOS**
- **MySQL**: Principal (InfinityFree)
- **SQLite**: Automático en desarrollo local
- **Sin configuración manual**

---

## 🛠️ **PROBLEMAS COMUNES**

### **"php: command not found"**
Instalar PHP según tu distribución (ver arriba)

### **"Port 8000 is already in use"**
```bash
php -S localhost:8080
```

### **Base de datos vacía**
```bash
rm database/techstore.db
# Recargar navegador
```

---

## ✅ **VERIFICACIÓN**
- [ ] PHP instalado
- [ ] Servidor corriendo
