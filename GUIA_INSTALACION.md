# 📋 **GUÍA DE INSTALACIÓN - TechStore**
### Sistema de Gestión de Productos Tecnológicos

---

## 🎯 **Para el Equipo de Desarrollo**

Esta guía te permitirá instalar y ejecutar la aplicación **TechStore** en tu computadora local para desarrollo y pruebas.

---

## 📋 **PRERREQUISITOS**

### **1. Sistema Operativo**
- ✅ **macOS** (recomendado)
- ✅ **Windows 10/11**
- ✅ **Linux Ubuntu/Debian**

### **2. Herramientas Necesarias**
- 🍺 **Homebrew** (macOS) o **Chocolatey** (Windows)
- 🌐 **Navegador web** (Chrome, Firefox, Safari)
- 💻 **Terminal** o **Command Prompt**

---

## 🚀 **INSTALACIÓN PASO A PASO**

### **PASO 1: Instalar PHP**

#### **En macOS:**
```bash
# Instalar Homebrew si no lo tienes
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Instalar PHP
brew install php
```

#### **En Windows:**
```bash
# Instalar Chocolatey si no lo tienes (ejecutar como Administrador)
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))

# Instalar PHP
choco install php
```

#### **En Linux (Ubuntu/Debian):**
```bash
sudo apt update
# IMPORTANTE: Este proyecto usa MySQL como BD principal
sudo apt install php php-mysql php-sqlite3 php-json php-mbstring
```

### **PASO 2: Verificar Instalación de PHP**
```bash
php --version
```
**Deberías ver algo como:** `PHP 8.x.x (cli)`

---

### **PASO 3: Descargar el Proyecto**

#### **Opción A: Con Git (recomendado)**
```bash
# Clonar el repositorio
git clone https://github.com/nkescobar/tech_store_app.git
cd tech_store_app
```

#### **Opción B: Descarga Directa**
1. Descarga el archivo ZIP del proyecto
2. Extrae en una carpeta llamada `tech_store_app`
3. Abre terminal en esa carpeta

---

### **PASO 4: Verificar Estructura del Proyecto**
```bash
ls -la
```

**Deberías ver:**
```
├── api/
├── config/
├── css/
├── js/
├── database/
├── index.php
├── README.md
└── GUIA_INSTALACION.md
```

---

### **PASO 5: Iniciar la Aplicación**
```bash
# Iniciar servidor PHP local
php -S localhost:8000
```

**Verás el mensaje:**
```
PHP 8.x.x Development Server (http://localhost:8000) started
```

---

### **PASO 6: Acceder a la Aplicación**

1. **Abrir navegador**
2. **Ir a:** `http://localhost:8000`
3. **¡Listo!** La aplicación debería cargar con productos de ejemplo

---

## 📊 **BASE DE DATOS DEL PROYECTO**

### **🚨 IMPORTANTE: Sistema Híbrido MySQL/SQLite**
- **🌐 MySQL**: Base de datos principal para el taller (InfinityFree/producción)
- **💻 SQLite**: Respaldo automático para desarrollo local
- **🔄 Detección automática**: Sin configuración manual

#### **¿Cómo funciona?**
1. **En producción** → Usa MySQL automáticamente
2. **En desarrollo** → Si MySQL no disponible, usa SQLite
3. **Resultado idéntico** → Mismos datos y funcionalidad

---

## 🔧 **FUNCIONALIDADES DISPONIBLES**

### **🛍️ Gestión de Productos**
- ✅ **Ver productos** con precios en pesos colombianos
- ✅ **Agregar productos** nuevos
- ✅ **Editar productos** (botón azul ✏️)
- ✅ **Eliminar productos** (botón rojo 🗑️)
- ✅ **Filtrar por categoría** y búsqueda de texto

### **📂 Gestión de Categorías**
- ✅ **Ver categorías** tecnológicas
- ✅ **Agregar categorías** nuevas

### **📊 Estadísticas**
- ✅ **Total de productos**
- ✅ **Stock total**
- ✅ **Valor del inventario**
- ✅ **Gráficos por categoría**

---

## 🗄️ **BASE DE DATOS**

### **Desarrollo Local**
- **Tipo:** SQLite (automático)
- **Ubicación:** `database/techstore.db`
- **Se crea automáticamente** al acceder por primera vez

### **Producción (InfinityFree)**
- **Tipo:** MySQL
- **Configuración:** Se detecta automáticamente

---

## 🛠️ **TROUBLESHOOTING**

### **❌ Error: "php: command not found"**
**Solución:**
```bash
# macOS
brew install php

# Windows
choco install php

# Linux
sudo apt install php
```

### **❌ Error: "Access denied for user 'root'"**
**Solución:** La app usa SQLite en local, MySQL solo en producción. Esto es normal.

### **❌ Error: "Port 8000 is already in use"**
**Solución:**
```bash
# Usar otro puerto
php -S localhost:8080

# O matar proceso existente
lsof -ti:8000 | xargs kill -9
```

### **❌ Las imágenes no cargan**
**Solución:**
- Verificar conexión a internet
- Las imágenes se cargan desde Unsplash
- Tienen fallback automático a imágenes aleatorias

### **❌ La base de datos está vacía**
**Solución:**
```bash
# Eliminar BD y regenerar
rm database/techstore.db
# Recargar http://localhost:8000
```

---

## 🌐 **URLS IMPORTANTES**

| Función | URL |
|---------|-----|
| **Aplicación Principal** | http://localhost:8000 |
| **API Productos** | http://localhost:8000/api/productos.php |
| **API Categorías** | http://localhost:8000/api/categorias.php |

---

## 📱 **TESTING**

### **Pruebas Básicas**
1. ✅ **Página principal** carga con productos
2. ✅ **Filtros** funcionan correctamente
3. ✅ **Agregar producto** funciona
4. ✅ **Editar producto** funciona
5. ✅ **Eliminar producto** funciona
6. ✅ **Estadísticas** se actualizan

### **Datos de Prueba**
**Productos incluidos:**
- iPhone 15 Pro ($5.499.900)
- MacBook Pro M3 ($10.599.900)
- NVIDIA RTX 4080 ($5.099.900)
- Sony WH-1000XM5 ($1.699.900)
- PlayStation 5 ($2.199.900)
- Apple Watch Series 9 ($1.699.900)
- Samsung Galaxy S24 ($3.899.900)
- Dell XPS 15 ($8.099.900)

**Categorías:**
- Smartphones, Laptops, Componentes PC, Audio, Gaming, Wearables

---

## 🚀 **DESPLIEGUE EN INFINITYFREE**

### **Archivos a Subir**
```
web/
├── api/
│   ├── productos.php
│   └── categorias.php
├── config/
│   └── database.php
├── css/
│   └── styles.css
├── js/
│   └── script.js
├── index.php
└── README.md
```

### **Configuración MySQL**
1. Crear base de datos en el panel de InfinityFree
2. Actualizar credenciales en `config/database.php`:
```php
private $host = 'sql200.infinityfree.com';
private $dbname = 'if0_xxxxxxx_techstore';
private $username = 'if0_xxxxxxx';
private $password = 'tu_password';
```

---

## ⚡ **COMANDOS RÁPIDOS**

### **Iniciar Aplicación**
```bash
cd web
php -S localhost:8000
```

### **Ver Logs en Tiempo Real**
```bash
tail -f /var/log/php_errors.log  # Linux/macOS
```

### **Resetear Base de Datos**
```bash
rm database/techstore.db
# Recargar navegador
```

### **Verificar API**
```bash
curl http://localhost:8000/api/productos.php
curl http://localhost:8000/api/categorias.php
```

---

## 📞 **SOPORTE**

### **Problemas Comunes**
- 🔍 **Revisar primero** la sección de Troubleshooting
- 🌐 **Verificar** que el puerto 8000 esté libre
- 🔄 **Reiniciar** el servidor PHP si hay problemas

### **Contacto**
- **Slack/Discord:** Canal del equipo
- **Email:** [tu-email@universidad.edu]

---

## 📚 **RECURSOS ADICIONALES**

- 📖 **Documentación PHP:** https://www.php.net/docs.php
- 🗄️ **SQLite Documentación:** https://www.sqlite.org/docs.html
- 🎨 **Unsplash API:** https://unsplash.com/developers
- 🌐 **InfinityFree Docs:** https://infinityfree.net/support

---

## ✅ **CHECKLIST FINAL**

Antes de reportar problemas, verifica:

- [ ] PHP está instalado (`php --version`)
- [ ] Terminal está en la carpeta correcta (`ls` muestra index.php)
- [ ] Servidor está corriendo (`php -S localhost:8000`)
- [ ] Navegador apunta a `http://localhost:8000`
- [ ] Puerto 8000 está libre
- [ ] Conexión a internet funciona (para imágenes)

---

## 🎉 **¡ÉXITO!**

Si llegaste hasta aquí y todo funciona:
- ✅ **TechStore** está funcionando
- ✅ **Base de datos** se creó automáticamente
- ✅ **Productos de ejemplo** están cargados
- ✅ **Todas las funciones** están disponibles

**¡Ahora puedes desarrollar y probar la aplicación!**

---

*Última actualización: Septiembre 2024*
*Versión: 1.0.0*