FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html/

# On donne la propriété du dossier à l'utilisateur Apache (www-data)
RUN chown -R www-data:www-data /var/www/html/front/uploads
# On s'assure que les dossiers sont lisibles (755) et les fichiers aussi (644)
RUN chmod -R 755 /var/www/html/front/uploads

# Donne les droits de lecture à Apache sur le dossier uploads
RUN chown -R www-data:www-data /var/www/html/front/uploads
RUN chmod -R 755 /var/www/html/front/uploads

ENV APACHE_DOCUMENT_ROOT /var/www/html/front
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

RUN a2enmod rewrite
