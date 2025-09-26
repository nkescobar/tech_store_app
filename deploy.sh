#!/bin/bash

# 🚀 Script de despliegue para TechStore en InfinityFree
# Uso: ./deploy.sh [archivo|all]

# Detectar directorio actual automáticamente
LOCAL_PATH="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

# Cargar configuración FTP
if [ -f "$LOCAL_PATH/ftp-config" ]; then
    source "$LOCAL_PATH/ftp-config"
    echo "✅ Configuración cargada desde ftp-config"
elif [ -f "$LOCAL_PATH/ftp-config.example" ]; then
    echo "⚠️  ADVERTENCIA: Necesitas crear tu archivo de configuración"
    echo "   Copia 'ftp-config.example' a 'ftp-config' y personaliza tus credenciales"
    echo ""
    echo "   cp ftp-config.example ftp-config"
    echo "   nano ftp-config  # Editar con tus datos"
    echo ""
    exit 1
else
    echo "❌ Error: No se encontró archivo de configuración"
    exit 1
fi

# Colores para output
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo "🚀 TechStore Deployment Script"
echo "==============================="

# Función para subir archivo individual
upload_file() {
    local file=$1
    local remote_dir=$2

    if [ ! -f "$LOCAL_PATH/$file" ]; then
        echo -e "${RED}❌ Archivo no encontrado: $file${NC}"
        return 1
    fi

    echo -e "${YELLOW}📤 Subiendo: $file${NC}"

    # Extraer solo el nombre del archivo para el destino
    filename=$(basename "$file")

    curl -T "$LOCAL_PATH/$file" \
         -u "$FTP_USER:$FTP_PASS" \
         "ftp://$FTP_HOST/$REMOTE_PATH/$remote_dir/$filename"

    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✅ $file subido exitosamente${NC}"
    else
        echo -e "${RED}❌ Error subiendo $file${NC}"
    fi
}

# Función para subir todos los archivos
upload_all() {
    echo "📦 Subiendo todos los archivos..."

    # Archivos principales
    upload_file "index.php" ""

    # API
    upload_file "productos.php" "api"
    upload_file "categorias.php" "api"

    # Configuración
    upload_file "config/database.php" "config"

    # Frontend
    upload_file "styles.css" "css"
    upload_file "script.js" "js"

    echo -e "${GREEN}🎉 ¡Despliegue completado!${NC}"
}

# Menú principal
case $1 in
    "all")
        upload_all
        ;;
    "index")
        upload_file "index.php" ""
        ;;
    "api")
        upload_file "productos.php" "api"
        upload_file "categorias.php" "api"
        ;;
    "config")
        upload_file "config/database.php" "config"
        ;;
    "js")
        upload_file "script.js" "js"
        ;;
    "css")
        upload_file "styles.css" "css"
        ;;
    *)
        echo "📋 Uso:"
        echo "  ./deploy.sh all      - Subir todos los archivos"
        echo "  ./deploy.sh index    - Subir solo index.php"
        echo "  ./deploy.sh api      - Subir archivos de API"
        echo "  ./deploy.sh config   - Subir configuración DB"
        echo "  ./deploy.sh js       - Subir JavaScript"
        echo "  ./deploy.sh css      - Subir estilos"
        echo ""
        echo "🌐 Sitio: https://techstoreapp.infinityfreeapp.com"
        ;;
esac