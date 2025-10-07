FROM php:8.2-apache

  # Habilitar extensiones de MySQL
  RUN docker-php-ext-install pdo pdo_mysql mysqli

  # Habilitar módulos de Apache
  RUN a2enmod rewrite headers

  # Configurar DocumentRoot
  WORKDIR /var/www/html

  # Copiar archivos de la aplicación
  COPY . /var/www/html/

  # Dar permisos
  RUN chown -R www-data:www-data /var/www/html