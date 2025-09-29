# 🌐 Proyecto Web en InfinityFree – Sector Tecnológico

## 👥 Integrantes y Roles
- **[Nombre completo]**  – Líder / Coordinador
- **[Nombre completo]** – Desarrollador Backend
- **[Nombre completo]** – Desarrollador Frontend / UI
- **[Nombre completo]** – Administrador de Base de Datos (DBA)
- **[Nombre completo]** – DevOps / Deployment
- **[Nombre completo]** – QA / Tester
- **[Nombre completo]** – Documentador / Presentador

## 📖 Descripción del Proyecto
**TechStore** es una aplicación web completa para la gestión de productos tecnológicos desarrollada en PHP con MySQL.
Permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) tanto en productos como categorías, con una interfaz responsive
y moderna. El sistema incluye validaciones de integridad referencial y está optimizado para dispositivos móviles.

## 🚀 Instrucciones de Uso
1. **Configurar Base de Datos**: Crear base de datos MySQL en InfinityFree
2. **Subir Archivos**: Cargar todos los archivos del proyecto a la carpeta `htdocs`
3. **Configurar Conexión**: La aplicación detecta automáticamente el entorno de InfinityFree
   - Host: `sql303.infinityfree.com`
   - Usuario: `if0_40011644`
   - Base de datos: `if0_40011644_techstore_db`
4. **Acceder al Sitio**:
   👉 **https://techstoreapp.infinityfreeapp.com**

## 🖼️ Evidencias de Despliegue
- **URL del sitio**: https://techstoreapp.infinityfreeapp.com
- **Base de datos MySQL**: `if0_40011644_techstore_db` con ≥8 productos y 6 categorías
- **Archivos desplegados**: Todos los archivos PHP, CSS, JS subidos via FTP
- **Funcionalidad verificada**: CRUD completo productos y categorías


## 📝 Changelog (registro de cambios)
- **[Nombre completo]** – Implementó sistema CRUD completo para productos y categorías con prepared statements
- **[Nombre completo]** – Diseñó interfaz responsive con CSS moderno y validaciones JavaScript
- **[Nombre completo]** – Configuró base de datos híbrida SQLite/MySQL con auto-detección de entorno
- **[Nombre completo]** – Desarrolló sistema de login completo con roles (admin/usuario) y hash de contraseñas
- **[Nombre completo]** – Organizó assets en carpeta static/ simulando arquitectura cloud (S3/Blob Storage)


## ❓ Preguntas de Reflexión (Cloud)

### 1. ¿Qué es despliegue y cómo lo hicieron en este proyecto?
> **Respuesta:** El despliegue es el proceso de poner una aplicación en funcionamiento en un servidor de producción accesible por usuarios finales. En este proyecto utilizamos InfinityFree como hosting gratuito, subiendo los archivos PHP via FTP, configurando una base de datos MySQL remota, y estableciendo la URL pública. Creamos un script automatizado (`deploy.sh`) que facilita la subida de archivos específicos (CSS, JS, API) de manera selectiva.

### 2. ¿Qué limitaciones encontraron en InfinityFree?
> **Respuesta:** Las principales limitaciones fueron: (1) No soporte para métodos HTTP PUT/DELETE, solucionado usando POST con parámetro `_method`, (2) Restricciones de ancho de banda y storage limitado, (3) No soporte para HTTPS personalizado sin upgrade, (4) Limitaciones en configuración de PHP y extensiones, (5) Posibles suspensiones por inactividad, (6) Rendimiento limitado comparado con servicios premium.

### 3. ¿Qué servicio equivalente usarían en AWS, Azure o GCP para:
> **Archivos estáticos:** AWS S3 + CloudFront, Azure Blob Storage + CDN, GCP Cloud Storage + Cloud CDN
>
> **Base de datos:** AWS RDS MySQL, Azure Database for MySQL, GCP Cloud SQL MySQL
>
> **Hosting del sitio:** AWS Elastic Beanstalk o EC2 + ALB, Azure App Service, GCP App Engine o Compute Engine

### 4. ¿Cómo resolverían escalabilidad y alta disponibilidad en la nube?
> **Respuesta:** Implementaríamos: (1) **Auto Scaling Groups** para ajustar instancias según demanda, (2) **Load Balancers** distribuyendo tráfico entre múltiples servidores, (3) **Base de datos replicada** con read replicas y failover automático, (4) **CDN global** para contenido estático, (5) **Múltiples zonas de disponibilidad** para redundancia geográfica, (6) **Monitoreo y alertas** con AWS CloudWatch/Azure Monitor/GCP Monitoring, (7) **CI/CD pipelines** para deployments zero-downtime.

### 5. Plan de migración en 4–5 pasos desde InfinityFree hacia un servicio en la nube
> **Respuesta:**
>
> **Paso 1:** Provisionar infraestructura cloud (VPC, subnets, security groups, RDS MySQL, EC2/App Service)
>
> **Paso 2:** Migrar base de datos exportando dump de MySQL actual e importándolo en RDS/Cloud SQL con configuración de conectividad
>
> **Paso 3:** Adaptar código actualizando strings de conexión, configurando variables de entorno, y ajustando para cloud-native features
>
> **Paso 4:** Implementar CI/CD con GitHub Actions/Azure DevOps/Cloud Build para automated deployment desde repositorio git
>
> **Paso 5:** Configurar monitoreo, logging, backups automáticos, y realizar testing completo antes de cambiar DNS para cutover final

---

## 📋 Documentación Técnica Adicional

### **⚡ Guías de Desarrollo Local**
- 📄 **[INICIO_RAPIDO.md](INICIO_RAPIDO.md)** - Ejecutar en 3 minutos
- 🍎 **[GUIA_MACOS.md](GUIA_MACOS.md)** - Instalación completa macOS
- 🪟 **[GUIA_WINDOWS.md](GUIA_WINDOWS.md)** - Instalación completa Windows
- 🐧 **[GUIA_LINUX.md](GUIA_LINUX.md)** - Instalación Ubuntu/CentOS/Arch

### **🚀 Guías de Despliegue**
- 📄 **[DEPLOY_INFINITYFREE.md](DEPLOY_INFINITYFREE.md)** - Despliegue paso a paso
- 📄 **[README_DEPLOY.md](README_DEPLOY.md)** - Script de deployment automático

---

## 🗄️ Base de Datos

### Tabla usuarios

```sql

CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    nombre_completo VARCHAR(100) NOT NULL,
    rol ENUM('admin', 'usuario') DEFAULT 'usuario',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activo BOOLEAN DEFAULT TRUE
);
```


### Tabla `productos`
```sql
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    descripcion TEXT,
    marca VARCHAR(100),
    stock INT DEFAULT 0,
    imagen_url VARCHAR(500),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### Tabla `categorias`
```sql
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE NOT NULL,
    descripcion TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## 🔗 API REST Endpoints

### Productos
- `GET /api/productos.php` - Listar todos los productos
- `GET /api/productos.php?id={id}` - Obtener producto específico
- `GET /api/productos.php?categoria=X` - Filtrar por categoría
- `GET /api/productos.php?busqueda=X` - Buscar productos
- `POST /api/productos.php` - Crear nuevo producto
- `POST /api/productos.php` + `_method=PUT` + `id` - Actualizar producto
- `POST /api/productos.php` + `_method=DELETE` + `id` - Eliminar producto

### Categorías
- `GET /api/categorias.php` - Listar todas las categorías
- `GET /api/categorias.php?id={id}` - Obtener categoría específica
- `POST /api/categorias.php` - Crear nueva categoría
- `POST /api/categorias.php` + `_method=PUT` + `id` - Actualizar categoría
- `POST /api/categorias.php` + `_method=DELETE` + `id` - Eliminar categoría

### 💻 Tecnologías Implementadas
- **Backend**: PHP 8.x con PDO y prepared statements
- **Base de Datos**: MySQL (producción) / SQLite (desarrollo)
- **Frontend**: HTML5, CSS3, JavaScript ES6+
- **APIs**: RESTful endpoints con manejo de errores
- **UX/UI**: Responsive design, lazy loading, animaciones CSS
- **DevOps**: Script automatizado de deployment FTP

### 🎯 Funcionalidades CRUD Completas
- ✅ **Productos**: Crear, Leer, Actualizar, Eliminar
- ✅ **Categorías**: Crear, Leer, Actualizar, Eliminar
- ✅ **Validaciones**: Integridad referencial y formularios
- ✅ **Interfaz**: Modos visuales de edición y confirmaciones
- ✅ **Mobile-First**: Optimizado para dispositivos móviles

---

## 👨‍💻 Autor

Desarrollado para el **Taller Diagnóstico - Arquitectura Cloud y Hosting Gratuito**

## 📄 Licencia

Este proyecto es de uso educativo.
