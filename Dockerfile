# Utilise une image PHP officielle avec Apache
FROM php:8.2-apache

# Installe l'extension PDO MySQL pour la base de données
RUN docker-php-ext-install pdo pdo_mysql

# Copie tout le contenu de ton projet vers le serveur
COPY . /var/www/html/

# On configure Apache pour qu'il pointe directement sur le dossier front
ENV APACHE_DOCUMENT_ROOT /var/www/html/front
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Active le module de réécriture d'Apache
RUN a2enmod rewrite