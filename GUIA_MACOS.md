# 🍎 **GUÍA DE INSTALACIÓN - macOS**

## 📋 **PRERREQUISITOS**
- macOS 10.15+ (Catalina o superior)
- Terminal

---

## 🚀 **INSTALACIÓN**

### **PASO 1: Instalar Homebrew**
```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

### **PASO 2: Instalar PHP**
```bash
brew install php
php --version
```

### **PASO 3: Descargar Proyecto**
```bash
git clone https://github.com/nkescobar/tech_store_app.git
cd tech_store_app
```

### **PASO 4: Ejecutar**
```bash
php -S localhost:8000
```

### **PASO 5: Abrir navegador**
http://localhost:8000

---

## 📊 **BASE DE DATOS**
- **MySQL**: Principal (InfinityFree)
- **SQLite**: Automático en desarrollo local
- **Sin configuración manual**

---

## 🛠️ **PROBLEMAS COMUNES**

### **"Command not found: php"**
```bash
brew install php
echo 'export PATH="/opt/homebrew/bin:$PATH"' >> ~/.zshrc
source ~/.zshrc
```

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
- [ ] Homebrew instalado
- [ ] PHP funciona
- [ ] Servidor corriendo
