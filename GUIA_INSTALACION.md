# 📋 **GUÍA DE INSTALACIÓN - TechStore**

## 📋 **PRERREQUISITOS**
- PHP 8.0 o superior
- Navegador web

---

## 🚀 **INSTALACIÓN**

### **PASO 1: Instalar PHP**

#### **macOS:**
```bash
brew install php
```

#### **Windows:**
```powershell
choco install php
```

#### **Linux:**
```bash
sudo apt install php php-mysql php-sqlite3
```

### **PASO 2: Descargar Proyecto**
```bash
git clone https://github.com/nkescobar/tech_store_app.git
cd tech_store_app
```

### **PASO 3: Ejecutar**
```bash
php -S localhost:8000
```

### **PASO 4: Abrir en navegador**
http://localhost:8000

---

## 📊 **BASE DE DATOS**
- **MySQL**: Principal (para InfinityFree)
- **SQLite**: Automático en desarrollo local
- **Sin configuración**: Se detecta automáticamente

---

## 🛠️ **PROBLEMAS COMUNES**

### **"php: command not found"**
Instalar PHP según tu sistema operativo (ver PASO 1)

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
- [ ] Página carga en http://localhost:8000
