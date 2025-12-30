FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql

# Copie du projet
COPY . /var/www/html/

# --- ACTIONS SUR LES PERMISSIONS ---
# On donne la propriété du dossier front/uploads à l'utilisateur Apache (www-data)
RUN chown -R www-data:www-data /var/www/html/front/uploads
# On autorise l'écriture (775 permet au groupe www-data d'écrire)
RUN chmod -R 775 /var/www/html/front/uploads

ENV APACHE_DOCUMENT_ROOT /var/www/html/front
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

RUN a2enmod rewrite