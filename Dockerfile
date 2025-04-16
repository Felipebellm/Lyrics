FROM php:8.2-apache

# Instalar extensões necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar mod_rewrite no Apache
RUN a2enmod rewrite

# Copiar arquivos do projeto para o container
COPY ./php /var/www/html

# Alterar permissões do diretório
RUN chown -R www-data:www-data /var/www/html

# Reiniciar Apache ao final
CMD ["apache2-foreground"]