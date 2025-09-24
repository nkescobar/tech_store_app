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

### **🔧 Guía General**
📄 **[README.md](README.md)** - Documentación principal con instalación

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
- 🌐 **MySQL** base de datos principal (InfinityFree/producción)
- 🖥️ **SQLite** respaldo para desarrollo local
- 🔄 **Detección automática** del entorno

#### **📋 ¿Cómo funciona el sistema híbrido?**
1. **🚀 En producción** (InfinityFree): Usa MySQL automáticamente
2. **💻 En desarrollo local**: Si MySQL no está disponible, usa SQLite
3. **🔄 Sin configuración**: El sistema detecta automáticamente qué BD usar
4. **📊 Mismo resultado**: Los datos y funcionalidad son idénticos

---

## 📋 **REQUISITOS MÍNIMOS**

| Componente | Versión Mínima |
|------------|----------------|
| **PHP** | 8.0+ |
| **MySQL** | 5.7+ (producción) o SQLite 3.x (desarrollo) |
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

**🎉 ¡Selecciona tu sistema operativo y comienza!**