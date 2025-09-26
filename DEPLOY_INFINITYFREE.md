# 🚀 **GUÍA DE DESPLIEGUE EN INFINITYFREE**
## TechStore - Paso a Paso

---

## 📋 **PREPARACIÓN ANTES DEL DESPLIEGUE**

### **✅ Archivos Listos para Subir:**
```
tech_store_app/
├── index.php              ✅ Página principal
├── api/
│   ├── productos.php      ✅ API de productos
│   └── categorias.php     ✅ API de categorías
├── config/
│   └── database.php       ✅ Conexión BD (auto-detecta MySQL)
├── css/
│   └── styles.css         ✅ Estilos
├── js/
│   └── script.js          ✅ JavaScript
├── README.md              ✅ Documentación
└── GUIAS/                 ✅ Documentación extra (opcional)
```

**🚫 NO subir:**
- `database/` (carpeta SQLite local)
- `.git/` (archivos de Git)
- Scripts de instalación local

---

## 🌐 **PASO 1: CREAR CUENTA EN INFINITYFREE**

### **1.1 Registro**
1. **Ir a:** https://infinityfree.net
2. **Click:** "Create Account"
3. **Completar** datos básicos
4. **Verificar** email

### **1.2 Crear Sitio Web**
1. **Login** en InfinityFree
2. **Click:** "Create Account" (nuevo sitio)
3. **Elegir subdominio:** `tu-proyecto.infinityfreeapp.com`
4. **Esperar** activación (1-5 minutos)

---

## 🗄️ **PASO 2: CONFIGURAR BASE DE DATOS MYSQL**

### **2.1 Crear Base de Datos**
1. **Panel de Control** → "MySQL Databases"
2. **Click:** "Create Database"
3. **Nombre:** `techstore_db` (o similar)
4. **Anotar datos:**
   ```
   Database Host: sqlXXX.infinityfree.com
   Database Name: if0_XXXXXXX_techstore_db
   Username: if0_XXXXXXX
   Password: [tu_password_generado]
   ```

### **2.2 Actualizar Configuración PHP**
**Editar `config/database.php`:**
```php
<?php
class Database {
    // CONFIGURACIÓN PARA INFINITYFREE
    private $host = 'sqlXXX.infinityfree.com';        // Del panel
    private $dbname = 'if0_XXXXXXX_techstore_db';     // Del panel
    private $username = 'if0_XXXXXXX';                // Del panel
    private $password = 'tu_password_aqui';           // Del panel
    private $pdo;

    public function __construct() {
        try {
            if ($this->isProduction()) {
                $this->connectMySQL();
            } else {
                $this->connectSQLite();
            }
            $this->createTables();
            $this->insertInitialData();
        } catch(PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    private function isProduction() {
        // Detectar InfinityFree automáticamente
        return isset($_SERVER['SERVER_NAME']) &&
               (strpos($_SERVER['SERVER_NAME'], 'infinityfree') !== false ||
                strpos($_SERVER['SERVER_NAME'], 'epizy') !== false);
    }

    // ... resto del código igual
```

---

## 📁 **PASO 3: SUBIR ARCHIVOS**

### **3.1 Acceder al File Manager**
1. **Panel InfinityFree** → "File Manager"
2. **Navegar a:** `htdocs/`
3. **Eliminar** archivos default (index.html, etc.)

### **3.2 Subir Archivos del Proyecto**
```
htdocs/
├── index.php
├── api/
│   ├── productos.php
│   └── categorias.php
├── config/
│   └── database.php       ← ¡CON CREDENCIALES MYSQL!
├── css/
│   └── styles.css
└── js/
    └── script.js
```

**💡 Métodos de subida:**
- **File Manager Web** (recomendado para principiantes)
- **FTP Client** (FileZilla, WinSCP)
- **Drag & Drop** en File Manager

### **3.3 Configurar Permisos**
- **Archivos PHP:** 644
- **Carpetas:** 755
- **index.php:** 644 (ejecutable automáticamente)

---

## 🧪 **PASO 4: PROBAR LA APLICACIÓN**

### **4.1 Verificaciones Básicas**
1. **Abrir:** `https://tu-subdominio.infinityfreeapp.com`
2. **Verificar:**
   - ✅ Página principal carga
   - ✅ CSS se aplica correctamente
   - ✅ JavaScript funciona
   - ✅ No hay errores 404

### **4.2 Probar Base de Datos**
1. **Primera visita** debe crear tablas automáticamente
2. **Verificar productos** aparecen (8 productos iniciales)
3. **Probar APIs directamente:**
   - `tu-sitio.com/api/productos.php`
   - `tu-sitio.com/api/categorias.php`

### **4.3 Probar Funcionalidades CRUD**
- ✅ **Agregar** producto nuevo
- ✅ **Editar** producto existente
- ✅ **Eliminar** producto
- ✅ **Filtros** por categoría
- ✅ **Búsquedas** de texto
- ✅ **Estadísticas** se actualizan

---

## 🐛 **PASO 5: SOLUCIÓN DE PROBLEMAS COMUNES**

### **❌ Error: "Database connection failed"**
**Solución:**
```php
// Verificar en config/database.php:
private $host = 'sqlXXX.infinityfree.com';     // ← Exacto del panel
private $dbname = 'if0_XXXXXXX_techstore_db';  // ← Nombre completo
private $username = 'if0_XXXXXXX';             // ← Usuario exacto
private $password = 'password_exacto';         // ← Sin espacios extra
```

### **❌ Error: "500 Internal Server Error"**
**Diagnóstico:**
1. **Ver Error Logs** en panel de InfinityFree
2. **Verificar sintaxis PHP:** `php -l index.php` (en local)
3. **Comprobar permisos** de archivos

**Soluciones comunes:**
```php
// Al inicio de index.php (temporal para debug):
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
```

### **❌ CSS/JS no cargan**
**Solución:**
- Verificar rutas: `css/styles.css` (no `/css/styles.css`)
- Verificar case-sensitive: `CSS/` vs `css/`
- Comprobar permisos: 644 para archivos

### **❌ APIs no responden**
**Verificar:**
```php
// En api/productos.php, agregar al inicio:
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Debug temporal:
error_log("API productos llamada: " . date('Y-m-d H:i:s'));
?>
```

---

## 📊 **PASO 6: OPTIMIZACIONES PARA INFINITYFREE**

### **6.1 Optimizar Performance**
```php
// En config/database.php
private function connectMySQL() {
    $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";

    // Opciones optimizadas para InfinityFree
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_PERSISTENT => false,  // No usar conexiones persistentes
        PDO::ATTR_TIMEOUT => 30,        // Timeout de 30 segundos
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ];

    $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
}
```

### **6.2 Cache Simple**
```php
// Opcional: cache básico para APIs
function getCachedData($cacheFile, $maxAge = 300) {
    if (file_exists($cacheFile) &&
        (time() - filemtime($cacheFile)) < $maxAge) {
        return file_get_contents($cacheFile);
    }
    return false;
}
```

### **6.3 Compresión de Imágenes**
```html
<!-- En index.php, optimizar imágenes Unsplash -->
<img src="https://images.unsplash.com/photo-xxx?w=300&h=200&fit=crop&q=80"
     alt="Producto" loading="lazy">
```

---

## 🔒 **PASO 7: SEGURIDAD EN PRODUCCIÓN**

### **7.1 Remover Información de Debug**
```php
// Eliminar de todos los archivos PHP:
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

### **7.2 Proteger Archivos Sensibles**
Crear `.htaccess` en carpeta raíz:
```apache
# Proteger archivos de configuración
<Files "*.md">
    Order Allow,Deny
    Deny from all
</Files>

# Ocultar archivos del sistema
<Files ".git*">
    Order Allow,Deny
    Deny from all
</Files>
```


**¡TechStore desplegado exitosamente en producción!** 🎯

---

*Guía creada para el Taller Diagnóstico*
*InfinityFree + PHP + MySQL*