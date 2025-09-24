# 🪟 **GUÍA DE INSTALACIÓN - WINDOWS**

## 📋 **PRERREQUISITOS**
- Windows 10/11
- PowerShell o Command Prompt

---

## 🚀 **INSTALACIÓN**

### **PASO 1: Instalar Chocolatey**
Abrir PowerShell como Administrador:
```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))
```

### **PASO 2: Instalar PHP**
```powershell
choco install php
php --version
```

### **PASO 3: Descargar Proyecto**
```powershell
git clone https://github.com/nkescobar/tech_store_app.git
cd tech_store_app
```

### **PASO 4: Ejecutar**
```powershell
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

### **"'php' is not recognized"**
```powershell
# Como Administrador
choco install php --force
```

### **"Port 8000 is already in use"**
```powershell
# Ver qué usa el puerto
netstat -ano | findstr :8000
# Matar proceso (reemplazar PID)
taskkill /PID 1234 /F
# O usar otro puerto
php -S localhost:8080
```

### **"Access Denied"**
```powershell
# Ejecutar PowerShell como Administrador
# Win + X → "Terminal (Administrador)"
```

---

## ✅ **VERIFICACIÓN**
- [ ] Chocolatey instalado
- [ ] PHP funciona
- [ ] Servidor corriendo
