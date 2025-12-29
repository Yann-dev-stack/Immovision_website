FROM php:8.2-apache
# Installation des extensions pour MySQL
RUN docker-php-ext-install pdo pdo_mysql
# Copie de tout ton projet dans le serveur
COPY . /var/www/html/
# On dit à Apache que le site est dans le dossier 'front'
RUN sed -ri -e 's!/var/www/html!/var/www/html/front!g' /etc/apache2/sites-available/*.conf