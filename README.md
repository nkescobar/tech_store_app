# TechStore - Sistema de Gestión de Productos Tecnológicos

## Descripción del Proyecto

TechStore es una aplicación web desarrollada en PHP para la gestión de productos tecnológicos. Este proyecto fue creado como parte del **Taller Diagnóstico - Sitio Web en Hosting Gratuito** para el sector tecnológico.

## 📚 **Guías de Instalación**

### **⚡ Inicio Rápido**
📄 **[INICIO_RAPIDO.md](INICIO_RAPIDO.md)** - Instalar y ejecutar en 3 minutos

### **📋 Guías por Sistema Operativo**
| Sistema | Guía | Descripción |
|---------|------|-------------|
| 🍎 **macOS** | **[GUIA_MACOS.md](GUIA_MACOS.md)** | Instalación completa con Homebrew |
| 🪟 **Windows** | **[GUIA_WINDOWS.md](GUIA_WINDOWS.md)** | Instalación completa con Chocolatey |
| 🐧 **Linux** | **[GUIA_LINUX.md](GUIA_LINUX.md)** | Ubuntu, CentOS, Arch y más |

### **🚀 Despliegue en Producción**
📄 **[DEPLOY_INFINITYFREE.md](DEPLOY_INFINITYFREE.md)** - Subir a InfinityFree paso a paso

### **📖 Índice Completo**
📄 **[README_INSTALACION.md](README_INSTALACION.md)** - Todas las guías organizadas

## Características

- ✅ **Página principal** con información del sector tecnológico
- ✅ **Formulario de registro** para agregar productos tecnológicos
- ✅ **Base de datos MySQL** con productos y categorías
- ✅ **Listado de productos** con filtros por categoría y búsqueda
- ✅ **Gestión de categorías** tecnológicas
- ✅ **Estadísticas** del inventario en tiempo real
- ✅ **Diseño responsive** y moderno

## Tecnologías Utilizadas

- **Backend**: PHP 8.x
- **Base de Datos**: MySQL (principal) / SQLite (desarrollo local)
- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Diseño**: CSS Grid, Flexbox, Gradientes modernos

## Estructura del Proyecto

```
tech_store_app/
├── index.php              # Página principal
├── config/
│   └── database.php       # Configuración híbrida MySQL/SQLite
├── api/
│   ├── productos.php      # API REST para productos
│   └── categorias.php     # API REST para categorías
├── css/
│   └── styles.css         # Estilos CSS
├── js/
│   └── script.js          # JavaScript frontend
├── database/
│   └── techstore.db       # Base de datos SQLite (solo desarrollo local)
├── GUIA_MACOS.md          # Guía instalación macOS
├── GUIA_WINDOWS.md        # Guía instalación Windows
├── GUIA_LINUX.md          # Guía instalación Linux
├── DEPLOY_INFINITYFREE.md # Guía despliegue producción
└── README_INSTALACION.md  # Índice de todas las guías
```

## Instalación Local

### Prerrequisitos
- PHP 8.0 o superior
- Extensión PDO MySQL habilitada
- MySQL 5.7+ (para producción) o SQLite (para desarrollo local)

### Instrucciones

1. **Clonar el proyecto**
   ```bash
   git clone https://github.com/nkescobar/tech_store_app.git
   cd tech_store_app
   ```

2. **Iniciar servidor PHP local**
   ```bash
   php -S localhost:8000
   ```

3. **Abrir en navegador**
   ```
   http://localhost:8000
   ```

## Funcionalidades Implementadas

### 1. Gestión Completa de Productos (CRUD)
- ➕ **Agregar productos** con información completa e imágenes
- ✏️ **Editar productos** existentes (botón azul)
- 🗑️ **Eliminar productos** (botón rojo con confirmación)
- 🔍 **Filtrar por categoría** y búsqueda de texto
- 🖼️ **Imágenes con lazy loading** desde Unsplash

### 2. Gestión de Categorías
- 📂 **Crear nuevas categorías** con descripción
- 📋 **Visualizar todas las categorías** disponibles
- 🛠️ **6 categorías predefinidas** del sector tecnológico

### 3. Panel de Estadísticas
- 📊 **Total de productos** registrados
- 📦 **Stock total** del inventario
- 💲 **Valor total** del inventario en COP
- 📈 **Gráficos por categorías** con barras visuales

### 4. Interfaz Moderna
- 📱 **100% responsive** para móviles y tablets
- ⚡ **Lazy loading** suave sin "brincos"
- 🎨 **Diseño moderno** con gradientes y animaciones
- 🌐 **Compatible** con todos los navegadores

## Base de Datos

### Tabla `productos`
```sql
CREATE TABLE productos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    categoria TEXT NOT NULL,
    precio REAL NOT NULL,
    descripcion TEXT,
    marca TEXT,
    stock INTEGER DEFAULT 0,
    imagen_url TEXT,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

### Tabla `categorias`
```sql
CREATE TABLE categorias (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT UNIQUE NOT NULL,
    descripcion TEXT
);
```

## API REST Endpoints

### Productos
- `GET /api/productos.php` - Listar todos los productos
- `GET /api/productos.php?categoria=X` - Filtrar por categoría
- `GET /api/productos.php?busqueda=X` - Buscar productos
- `POST /api/productos.php` - Crear nuevo producto
- `PUT /api/productos.php/{id}` - Actualizar producto
- `DELETE /api/productos.php/{id}` - Eliminar producto

### Categorías
- `GET /api/categorias.php` - Listar todas las categorías
- `POST /api/categorias.php` - Crear nueva categoría

## Datos de Ejemplo

El sistema incluye datos de muestra del sector tecnológico:

### Categorías Predefinidas
- Smartphones
- Laptops
- Componentes PC
- Audio
- Gaming
- Wearables

### Productos de Ejemplo (8 productos incluidos)
- iPhone 15 Pro ($5.499.900 COP)
- MacBook Pro M3 ($10.599.900 COP)
- NVIDIA RTX 4080 ($5.099.900 COP)
- Sony WH-1000XM5 ($1.699.900 COP)
- PlayStation 5 ($2.199.900 COP)
- Apple Watch Series 9 ($1.699.900 COP)
- Samsung Galaxy S24 ($3.899.900 COP)
- Dell XPS 15 ($8.099.900 COP)

## Despliegue en InfinityFree

### Pasos para el despliegue:

1. **Crear cuenta en InfinityFree**
   - Registrarse en infinityfree.com
   - Crear un nuevo sitio web

2. **Subir archivos**
   - Usar File Manager o FTP
   - Subir todos los archivos al directorio `htdocs`

3. **Configurar base de datos**
   - Crear base de datos MySQL desde el panel de control
   - Actualizar credenciales en `config/database.php`

4. **Probar funcionalidad**
   - Verificar que el sitio carga correctamente
   - Probar formularios y base de datos



## Autor

Desarrollado para el Taller Diagnóstico - Arquitectura Cloud y Hosting Gratuito

## Licencia

Este proyecto es de uso educativo.