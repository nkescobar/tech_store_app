# 📦 **DESPLIEGUE RÁPIDO - TechStore**

## 🚀 **Configuración en 3 pasos:**

### **1️⃣ Configurar credenciales:**
```bash
cp ftp-config.example ftp-config
nano ftp-config  # Editar con tus datos de InfinityFree
```

### **2️⃣ Hacer ejecutable:**
```bash
chmod +x deploy.sh
```

### **3️⃣ Desplegar:**
```bash
./deploy.sh all  # Subir todo
```

---

## 📋 **Comandos útiles:**

```bash
./deploy.sh all      # Despliegue completo
./deploy.sh js       # Solo JavaScript
./deploy.sh api      # Solo APIs (productos.php, categorias.php)
./deploy.sh config   # Solo configuración BD
./deploy.sh css      # Solo estilos
./deploy.sh index    # Solo página principal
```

---

## ⚠️ **Importante:**
- El archivo `ftp-config` contiene credenciales sensibles
- **NO** lo subas a Git (ya está en .gitignore)
- Cada desarrollador debe crear su propio `ftp-config`

---

**🌐 Sitio:** https://techstoreapp.infinityfreeapp.com