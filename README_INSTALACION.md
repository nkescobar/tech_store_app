# 📚 **GUÍAS DE INSTALACIÓN - TechStore**
## Sistema de Gestión de Productos Tecnológicos

---

## 🎯 **ELIGE TU SISTEMA OPERATIVO**

### **⚡ Inicio Súper Rápido (3 minutos)**
📄 **[INICIO_RAPIDO.md](INICIO_RAPIDO.md)** - Para los que quieren empezar YA

---

### **📋 Guías Detalladas por Sistema**

| Sistema | Archivo | Descripción |
|---------|---------|-------------|
| 🍎 **macOS** | **[GUIA_MACOS.md](GUIA_MACOS.md)** | Guía completa para Mac con Homebrew |
| 🪟 **Windows** | **[GUIA_WINDOWS.md](GUIA_WINDOWS.md)** | Guía completa para Windows con Chocolatey |
| 🐧 **Linux** | **[GUIA_LINUX.md](GUIA_LINUX.md)** | Ubuntu, CentOS, Arch, openSUSE y más |

### **🔧 Guía Universal**
📄 **[GUIA_INSTALACION.md](GUIA_INSTALACION.md)** - Guía general para todos los sistemas

---

## 🚀 **REPOSITORIO DEL PROYECTO**

```bash
# Clonar el proyecto
git clone https://github.com/nkescobar/tech_store_app.git
cd tech_store_app

# Iniciar aplicación
php -S localhost:8000
```

**🌐 Acceder en:** http://localhost:8000

---

## 🎯 **¿QUÉ CONTIENE CADA GUÍA?**

### **📱 Inicio Rápido**
- ✅ 3 pasos básicos
- ✅ Comandos directos
- ✅ Sin explicaciones largas
- ⏱️ **Tiempo:** 3-5 minutos

### **🍎 Guía macOS**
- ✅ Instalación con Homebrew
- ✅ Terminal y comandos específicos
- ✅ Troubleshooting para Mac
- ✅ Optimizaciones y automatización
- ⏱️ **Tiempo:** 10-15 minutos

### **🪟 Guía Windows**
- ✅ Instalación con Chocolatey
- ✅ PowerShell y CMD
- ✅ Configuración de PATH
- ✅ Scripts automáticos (.bat)
- ⏱️ **Tiempo:** 10-15 minutos

### **🐧 Guía Linux**
- ✅ Ubuntu, Debian, CentOS, Arch, openSUSE
- ✅ Gestores de paquetes específicos
- ✅ Configuraciones de seguridad
- ✅ Servicios systemd opcionales
- ⏱️ **Tiempo:** 15-20 minutos

---

## 🛠️ **HERRAMIENTAS INCLUIDAS**

### **📜 Scripts de Instalación**
- 🍎 **install_mac.sh** - Script automático para macOS/Linux
- 🪟 **INSTALL_WINDOWS.bat** - Script automático para Windows

### **🔍 Scripts de Verificación**
- ✅ Verificación automática de PHP
- ✅ Verificación de estructura del proyecto
- ✅ Verificación de puertos libres

---

## 🎯 **FUNCIONALIDADES DE LA APLICACIÓN**

### **🛍️ Gestión de Productos**
- ➕ **Agregar productos** con imágenes
- ✏️ **Editar productos** (botón azul)
- 🗑️ **Eliminar productos** (botón rojo)
- 🔍 **Filtrar y buscar** productos

### **📂 Gestión de Categorías**
- 📋 **Ver categorías** tecnológicas
- ➕ **Agregar nuevas** categorías

### **📊 Panel de Control**
- 📈 **Estadísticas** del inventario
- 💰 **Valor total** en pesos colombianos
- 📊 **Gráficos** por categoría

### **🗄️ Base de Datos**
- 🖥️ **SQLite** para desarrollo local
- 🌐 **MySQL** para producción (InfinityFree)
- 🔄 **Detección automática** del entorno

---

## 📋 **REQUISITOS MÍNIMOS**

| Componente | Versión Mínima |
|------------|----------------|
| **PHP** | 8.0+ |
| **SQLite** | 3.x (incluido en PHP) |
| **Navegador** | Chrome 90+, Firefox 88+, Safari 14+ |
| **Memoria RAM** | 512 MB disponible |
| **Disco** | 50 MB libres |

---

## 🆘 **SOPORTE Y PROBLEMAS**

### **🔧 Problemas Comunes**
1. **"php: command not found"** → Ver guía de tu sistema operativo
2. **"Port 8000 is already in use"** → Usar `php -S localhost:8080`
3. **Imágenes no cargan** → Verificar conexión a internet
4. **Base de datos vacía** → Eliminar `database/techstore.db` y recargar

### **📞 Contacto**
- **GitHub Issues:** https://github.com/nkescobar/tech_store_app/issues
- **Discord/Slack:** Canal del equipo
- **Email:** [tu-email@universidad.edu]

---

## 📊 **DATOS DE PRUEBA INCLUIDOS**

### **🛍️ Productos de Ejemplo** (8 productos)
- iPhone 15 Pro ($5.499.900 COP)
- MacBook Pro M3 ($10.599.900 COP)
- NVIDIA RTX 4080 ($5.099.900 COP)
- Sony WH-1000XM5 ($1.699.900 COP)
- PlayStation 5 ($2.199.900 COP)
- Apple Watch Series 9 ($1.699.900 COP)
- Samsung Galaxy S24 ($3.899.900 COP)
- Dell XPS 15 ($8.099.900 COP)

### **📂 Categorías Incluidas** (6 categorías)
- Smartphones, Laptops, Componentes PC
- Audio, Gaming, Wearables

---

## 🚀 **NEXT STEPS DESPUÉS DE LA INSTALACIÓN**

### **1. ✅ Verificar que Todo Funciona**
- [ ] Página principal carga correctamente
- [ ] Productos se muestran con imágenes
- [ ] Precios en pesos colombianos
- [ ] Filtros funcionan
- [ ] Formularios agregar/editar funcionan

### **2. 🧪 Probar Funcionalidades**
- [ ] Agregar un producto nuevo
- [ ] Editar un producto existente
- [ ] Eliminar un producto
- [ ] Crear nueva categoría
- [ ] Verificar estadísticas se actualizan

### **3. 🌐 Preparar para Producción**
- [ ] Crear cuenta en InfinityFree
- [ ] Configurar base de datos MySQL
- [ ] Subir archivos al hosting
- [ ] Probar en producción

---

## 📈 **ROADMAP DEL PROYECTO**

### **✅ Completado**
- ✅ CRUD completo de productos
- ✅ Gestión de categorías
- ✅ Base de datos híbrida (SQLite/MySQL)
- ✅ Interfaz responsive moderna
- ✅ Lazy loading de imágenes
- ✅ Precios en pesos colombianos
- ✅ Guías de instalación completas

### **🔄 En Desarrollo**
- 🔄 Panel de administración
- 🔄 Sistema de usuarios
- 🔄 Reportes PDF
- 🔄 API REST documentada

### **📅 Próximas Funcionalidades**
- 📅 Carrito de compras
- 📅 Sistema de facturación
- 📅 Integración con pasarelas de pago
- 📅 Notificaciones push

---

## 🏆 **OBJETIVOS DEL TALLER**

### **✅ Cumplidos**
- [x] **Sitio web** con página principal
- [x] **Formulario** de registro funcional
- [x] **Base de datos MySQL** (preparada)
- [x] **Listado** de registros desde BD
- [x] **Sector tecnológico** implementado
- [x] **Funcionalidades CRUD** completas

### **🎯 Para el Despliegue en InfinityFree**
- [ ] Cuenta creada en InfinityFree
- [ ] Base de datos MySQL configurada
- [ ] Archivos subidos al hosting
- [ ] Aplicación funcionando en producción
- [ ] 3+ registros de prueba en producción

---

**🎉 ¡Selecciona tu sistema operativo y comienza en minutos!**

*Última actualización: Septiembre 2024*
*TechStore v1.0.0*