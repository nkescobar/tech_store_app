# 🍎 **GUÍA DE INSTALACIÓN - macOS**
## TechStore - Sistema de Gestión de Productos Tecnológicos

---

## 📋 **PRERREQUISITOS**

### **Sistema Operativo**
- ✅ **macOS 10.15+** (Catalina o superior)
- ✅ **Terminal** (aplicación nativa)
- ✅ **Navegador web** (Safari, Chrome, Firefox)

### **Herramientas de Desarrollo**
- 🛠️ **Xcode Command Line Tools** (se instala automáticamente con Homebrew)

---

## 🚀 **INSTALACIÓN PASO A PASO**

### **PASO 1: Instalar Homebrew**

**¿Qué es Homebrew?** Es el gestor de paquetes más popular para macOS.

1. **Abrir Terminal** (⌘ + Espacio, escribir "Terminal")

2. **Instalar Homebrew:**
```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

3. **Verificar instalación:**
```bash
brew --version
```

**Deberías ver:** `Homebrew 4.x.x`

### **PASO 2: Instalar PHP**

```bash
# Instalar PHP con todas las extensiones necesarias
brew install php

# Verificar instalación
php --version
```

**Salida esperada:**
```
PHP 8.4.x (cli) (built: ...)
Copyright (c) The PHP Group
Zend Engine v4.4.x, Copyright (c) Zend Technologies
```

### **PASO 3: Descargar el Proyecto**

#### **Opción A: Con Git**
```bash
# Si tienes Git instalado
git clone https://github.com/nkescobar/tech_store_app.git
cd tech_store_app
```

#### **Opción B: Descarga Manual**
1. **Descargar** el archivo ZIP del proyecto
2. **Extraer** en el Escritorio o carpeta de preferencia
3. **Renombrar** la carpeta a `tech_store_app`
4. **Navegar** en Terminal:
```bash
cd ~/Desktop/tech_store_app
# o la ruta donde extrajiste el proyecto
```

### **PASO 4: Verificar Estructura del Proyecto**

```bash
ls -la
```

**Deberías ver:**
```
drwxr-xr-x   api/
drwxr-xr-x   config/
drwxr-xr-x   css/
drwxr-xr-x   js/
-rw-r--r--   index.php
-rw-r--r--   README.md
-rwxr-xr-x   install_mac.sh
```

### **PASO 5: Ejecutar la Aplicación**

#### **Método 1: Script Automático (Recomendado)**
```bash
# Dar permisos de ejecución
chmod +x install_mac.sh

# Ejecutar script
./install_mac.sh
```

#### **Método 2: Manual**
```bash
# Iniciar servidor PHP
php -S localhost:8000
```

### **PASO 6: Acceder a la Aplicación**

1. **Abrir navegador**
2. **Ir a:** `http://localhost:8000`
3. **¡Listo!** La aplicación carga con productos de ejemplo

---

## 🔧 **COMANDOS ÚTILES PARA macOS**

### **Gestión del Servidor**
```bash
# Iniciar servidor en puerto 8000
php -S localhost:8000

# Iniciar en otro puerto si 8000 está ocupado
php -S localhost:8080

# Ver qué está usando el puerto 8000
lsof -ti:8000

# Matar proceso en puerto 8000
lsof -ti:8000 | xargs kill -9
```

### **Gestión de Archivos**
```bash
# Ver archivos ocultos
ls -la

# Navegar a carpeta del proyecto
cd ~/tech_store_app

# Abrir Finder en la carpeta actual
open .

# Editar archivo con nano
nano config/database.php
```

### **Base de Datos**
```bash
# 📊 IMPORTANTE: Base de Datos del Proyecto
# El proyecto usa MYSQL como base de datos principal para el taller
# SQLite solo se usa automáticamente para desarrollo local cuando MySQL no está disponible

# Ver archivos de base de datos
ls -la database/

# Si quieres consultar la base de datos local de desarrollo:
brew install sqlite3
sqlite3 database/techstore.db "SELECT * FROM productos LIMIT 5;"

# NOTA: En producción (InfinityFree) se usará MySQL automáticamente

# 🔧 OPCIONAL: Instalar MySQL localmente (no requerido para el taller)
# Solo si quieres usar MySQL en desarrollo local también
brew install mysql
brew services start mysql
mysql -u root -p
```

---

## 🛠️ **TROUBLESHOOTING ESPECÍFICO PARA macOS**

### **❌ Error: "Command not found: php"**
```bash
# Solución 1: Instalar PHP
brew install php

# Solución 2: Agregar PHP al PATH
echo 'export PATH="/opt/homebrew/bin:$PATH"' >> ~/.zshrc
source ~/.zshrc

# Solución 3: Para Macs Intel (x86)
echo 'export PATH="/usr/local/bin:$PATH"' >> ~/.zshrc
source ~/.zshrc
```

### **❌ Error: "Permission denied"**
```bash
# Dar permisos al script
chmod +x install_mac.sh

# O ejecutar con bash
bash install_mac.sh
```

### **❌ Error: "Address already in use"**
```bash
# Ver qué proceso usa el puerto
lsof -i :8000

# Matar el proceso
kill -9 [PID]

# O usar otro puerto
php -S localhost:8080
```

### **❌ Error: "xcrun: error: invalid active developer path"**
```bash
# Instalar Xcode Command Line Tools
xcode-select --install
```

### **❌ Homebrew no funciona en Apple Silicon (M1/M2)**
```bash
# Agregar Homebrew ARM64 al PATH
echo 'export PATH="/opt/homebrew/bin:$PATH"' >> ~/.zshrc
source ~/.zshrc
```

---

## 🚀 **OPTIMIZACIONES PARA macOS**

### **Configuración de Terminal**
```bash
# Crear alias para inicio rápido
echo 'alias techstore="cd ~/tech_store_app && php -S localhost:8000"' >> ~/.zshrc
source ~/.zshrc

# Ahora solo escribe 'techstore' para iniciar
```

### **Configuración de PHP**
```bash
# Ubicación del archivo php.ini
php --ini

# Editar configuración PHP (opcional)
nano /opt/homebrew/etc/php/8.4/php.ini
```

### **Automatización con Automator**
1. **Abrir Automator**
2. **Crear nueva Aplicación**
3. **Agregar acción "Ejecutar Script de Shell"**
4. **Script:**
```bash
cd ~/tech_store_app
php -S localhost:8000
```
5. **Guardar como "TechStore.app"**

---

## 🔄 **ACTUALIZACIONES**

### **Actualizar PHP**
```bash
# Actualizar Homebrew
brew update

# Actualizar PHP
brew upgrade php

# Verificar nueva versión
php --version
```

### **Actualizar el Proyecto**
```bash
# Si usas Git
git pull origin main

# Si descargaste manualmente
# Reemplazar archivos manteniendo database/
```

---

## 📊 **MONITOREO Y DEBUG**

### **Ver Logs de PHP**
```bash
# Ver errores de PHP en tiempo real
tail -f /opt/homebrew/var/log/php-fpm.log

# Ver log del servidor PHP
php -S localhost:8000 -t . 2>&1 | tee server.log
```

### **Verificar APIs**
```bash
# Probar API de productos
curl http://localhost:8000/api/productos.php

# Probar API de categorías
curl http://localhost:8000/api/categorias.php

# Probar con formato JSON legible
curl http://localhost:8000/api/productos.php | python3 -m json.tool
```

---

## 🎯 **INTEGRACIÓN CON HERRAMIENTAS macOS**

### **Visual Studio Code**
```bash
# Instalar VS Code desde Homebrew
brew install --cask visual-studio-code

# Abrir proyecto en VS Code
code .
```

### **Chrome Developer Tools**
1. **Abrir** http://localhost:8000
2. **Presionar** ⌥⌘I (Option+Cmd+I)
3. **Usar** Network tab para debug de APIs

### **Terminal Dividida**
```bash
# Usar iTerm2 para mejor experiencia
brew install --cask iterm2

# En iTerm2: ⌘D para dividir vertical
# Panel 1: servidor PHP
# Panel 2: comandos de desarrollo
```

---

## ✅ **VERIFICACIÓN FINAL macOS**

### **Checklist Completo**
- [ ] **Homebrew** instalado (`brew --version`)
- [ ] **PHP** instalado (`php --version`)
- [ ] **Proyecto** descargado y en carpeta correcta
- [ ] **Servidor** iniciado (`php -S localhost:8000`)
- [ ] **Navegador** abre http://localhost:8000
- [ ] **Productos** cargan correctamente
- [ ] **Base de datos** se crea en `database/techstore.db`
- [ ] **Funciones** CRUD funcionan
- [ ] **APIs** responden (`/api/productos.php`)

### **Comandos de Verificación**
```bash
# Verificar todo de una vez
echo "=== VERIFICACIÓN TECHSTORE ===" && \
echo "PHP: $(php --version | head -1)" && \
echo "Proyecto: $(ls index.php 2>/dev/null && echo "✅ OK" || echo "❌ FALTA")" && \
echo "Puerto 8000: $(lsof -ti:8000 >/dev/null && echo "✅ OCUPADO" || echo "✅ LIBRE")" && \
echo "=== LISTO PARA INICIAR ==="
```

---

## 🆘 **SOPORTE ESPECÍFICO macOS**

### **Recursos macOS**
- 🍺 **Homebrew Docs:** https://docs.brew.sh
- 🔧 **macOS PHP Guide:** https://php-osx.liip.ch
- 💻 **Terminal Cheat Sheet:** https://github.com/0nn0/terminal-mac-cheatsheet

### **Comandos de Emergencia**
```bash
# Reset completo PHP
brew uninstall php
brew install php

# Limpiar cache Homebrew
brew cleanup

# Reparar permisos
sudo chown -R $(whoami) /opt/homebrew
```

---

**🎉 ¡TechStore funcionando perfectamente en macOS!**

*Última actualización: Septiembre 2024*
*Versión: macOS 1.0.0*