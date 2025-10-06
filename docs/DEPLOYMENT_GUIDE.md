# 🚀 **GUÍA DE DESPLIEGUE - TechStore**

## 📋 **Configuración inicial**

### **1. Configurar tus credenciales FTP:**

```bash
# Copiar archivo de ejemplo
cp ftp-config.example ftp-config

# Editar con tus credenciales de InfinityFree
nano ftp-config
```

### **2. En el archivo `ftp-config`, personalizar:**
```bash
FTP_HOST="ftpupload.net"
FTP_USER="tu_usuario_infinityfree"    # ej: if0_12345678
FTP_PASS="tu_password_infinityfree"   # tu contraseña
REMOTE_PATH="htdocs"
```

---

## 🛠️ **Método 1: Script Automático (Recomendado)**

### **Configuración inicial (solo primera vez):**

```bash
# Hacer ejecutable
chmod +x deploy.sh

# Configurar credenciales
cp ftp-config.example ftp-config
nano ftp-config  # Editar con tus datos
```

### **Uso del script `deploy.sh`:**

```bash

# Subir todos los archivos
./deploy.sh all

# Subir archivos específicos
./deploy.sh js       # Solo JavaScript
./deploy.sh api      # Solo APIs (productos.php, categorias.php)
./deploy.sh config   # Solo configuración (database.php)
./deploy.sh css      # Solo estilos
./deploy.sh index    # Solo página principal
```

### **Ejemplos comunes:**
```bash
# Después de cambiar JavaScript
./deploy.sh js

# Después de cambiar APIs
./deploy.sh api

# Despliegue completo
./deploy.sh all
```

---

## 📦 **Método 2: Comandos curl manuales**

### **Subir archivos individuales:**

```bash
# Página principal
curl -T "index.php" -u "if0_40011644:lqdc0hq28Ya977" "ftp://ftpupload.net/htdocs/"

# JavaScript
curl -T "js/script.js" -u "if0_40011644:lqdc0hq28Ya977" "ftp://ftpupload.net/htdocs/js/"

# CSS
curl -T "css/styles.css" -u "if0_40011644:lqdc0hq28Ya977" "ftp://ftpupload.net/htdocs/css/"

# API Productos
curl -T "api/productos.php" -u "if0_40011644:lqdc0hq28Ya977" "ftp://ftpupload.net/htdocs/api/"

# API Categorías
curl -T "api/categorias.php" -u "if0_40011644:lqdc0hq28Ya977" "ftp://ftpupload.net/htdocs/api/"

# Configuración BD
curl -T "config/database.php" -u "if0_40011644:lqdc0hq28Ya977" "ftp://ftpupload.net/htdocs/config/"
```

---

## 🖥️ **Método 3: Clientes FTP gráficos**

### **Para Mac:**
- **Cyberduck** (gratuito): https://cyberduck.io
- **Transmit** (de pago)
- **FileZilla** (gratuito)

### **Para Windows:**
- **WinSCP** (gratuito)
- **FileZilla** (gratuito)
- **Total Commander** con plugin FTP

### **Configuración:**
- Protocolo: **FTP**
- Servidor: `ftpupload.net`
- Puerto: `21`
- Usuario: `if0_40011644`
- Contraseña: `lqdc0hq28Ya977`

---

## 📂 **Estructura de archivos en servidor**

```
htdocs/
├── index.php                 # Página principal
├── api/
│   ├── productos.php         # API productos
│   └── categorias.php        # API categorías
├── config/
│   └── database.php          # Configuración BD
├── css/
│   └── styles.css            # Estilos
└── js/
    └── script.js             # JavaScript
```

---

## 🔧 **Comandos de verificación**

### **Después del despliegue, verificar:**

```bash
# Verificar que los archivos existan
curl -I https://techstoreapp.infinityfreeapp.com/js/script.js
curl -I https://techstoreapp.infinityfreeapp.com/css/styles.css
curl -I https://techstoreapp.infinityfreeapp.com/api/productos.php

# Probar la aplicación
open https://techstoreapp.infinityfreeapp.com
```

---

## ⚠️ **Problemas comunes**

### **Error 403/404 después de subir:**
- **Limpiar cache** del navegador: `Cmd+Shift+R` (Mac) o `Ctrl+F5` (Windows)
- **Verificar permisos** de archivos (deben ser 644 para archivos, 755 para carpetas)

### **JavaScript no se actualiza:**
- **Cache del navegador**: Recargar con `Shift+F5`
- **Cache del servidor**: Esperar 1-2 minutos

### **Error de conexión FTP:**
- Verificar credenciales
- Probar desde terminal: `curl -u "if0_40011644:lqdc0hq28Ya977" "ftp://ftpupload.net/"`

---

## 📊 **Checklist post-despliegue**

- [ ] **Sitio carga** en https://techstoreapp.infinityfreeapp.com
- [ ] **Productos aparecen** correctamente
- [ ] **Crear producto** funciona
- [ ] **Editar producto** funciona
- [ ] **Eliminar producto** funciona
- [ ] **Crear categorías** funciona
- [ ] **Filtros y búsquedas** funcionan
- [ ] **Responsive móvil** funciona

---

## 🆘 **Soporte**

### **URLs importantes:**
- **Aplicación:** https://techstoreapp.infinityfreeapp.com
- **Panel InfinityFree:** https://infinityfree.net
- **phpMyAdmin:** Desde panel InfinityFree

### **En caso de problemas:**
1. **Revisar logs** en panel InfinityFree
2. **Verificar** conexión de base de datos
3. **Limpiar cache** del navegador
4. **Resubir archivos** afectados

---

*Última actualización: Septiembre 2024*
*TechStore v1.0 - InfinityFree*