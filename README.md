# TechStore - Sistema de Gestión de Productos Tecnológicos

## Descripción del Proyecto

TechStore es una aplicación web desarrollada en PHP para la gestión de productos tecnológicos. Este proyecto fue creado como parte del **Taller Diagnóstico - Sitio Web en Hosting Gratuito** para el sector tecnológico.

## Características

- ✅ **Página principal** con información del sector tecnológico
- ✅ **Formulario de registro** para agregar productos tecnológicos
- ✅ **Base de datos SQLite** con productos y categorías
- ✅ **Listado de productos** con filtros por categoría y búsqueda
- ✅ **Gestión de categorías** tecnológicas
- ✅ **Estadísticas** del inventario en tiempo real
- ✅ **Diseño responsive** y moderno

## Tecnologías Utilizadas

- **Backend**: PHP 8.x
- **Base de Datos**: SQLite
- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Diseño**: CSS Grid, Flexbox, Gradientes modernos

## Estructura del Proyecto

```
/
├── index.php              # Página principal
├── config/
│   └── database.php       # Configuración de base de datos
├── api/
│   ├── productos.php      # API REST para productos
│   └── categorias.php     # API REST para categorías
├── css/
│   └── styles.css         # Estilos CSS
├── js/
│   └── script.js          # JavaScript frontend
└── database/
    └── techstore.db       # Base de datos SQLite (generada automáticamente)
```

## Instalación Local

### Prerrequisitos
- PHP 8.0 o superior
- Extensión PDO SQLite habilitada

### Instrucciones

1. **Clonar el proyecto**
   ```bash
   git clone [url-del-repositorio]
   cd web
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

### 1. Gestión de Productos
- Agregar productos con información completa
- Filtrar por categoría y búsqueda de texto
- Visualización en tarjetas con imágenes
- Información de stock y precios

### 2. Gestión de Categorías
- Crear nuevas categorías
- Visualización de todas las categorías disponibles
- Categorías predefinidas del sector tecnológico

### 3. Estadísticas
- Total de productos registrados
- Stock total del inventario
- Valor total del inventario
- Distribución por categorías

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

### Productos de Ejemplo
- iPhone 15 Pro
- MacBook Pro M3
- NVIDIA RTX 4080
- Sony WH-1000XM5
- PlayStation 5
- Apple Watch Series 9
- Samsung Galaxy S24
- Dell XPS 15

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

## Consideraciones de Arquitectura Cloud

### Limitaciones del Hosting Gratuito
- **Disponibilidad**: Tiempo de actividad no garantizado
- **Escalabilidad**: Recursos limitados para alto tráfico
- **Seguridad**: Menor control sobre configuraciones de seguridad

### Migración a AWS
1. **EC2**: Para el servidor web y aplicación PHP
2. **RDS**: Para la base de datos MySQL/PostgreSQL
3. **S3**: Para almacenamiento de imágenes de productos
4. **Route 53**: Para gestión de DNS y dominio

## Seguridad Implementada

- Validación de entrada en formularios
- Uso de declaraciones preparadas (PDO)
- Validación de URLs de imágenes
- Manejo de errores controlado

## Autor

Desarrollado para el Taller Diagnóstico - Arquitectura Cloud y Hosting Gratuito

## Licencia

Este proyecto es de uso educativo.