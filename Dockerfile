FROM php:8.2-apache

# Instala dependências do sistema, SQLite e Node.js (para o Vite)
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev libsqlite3-dev zip unzip git curl \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring gd

# Instala o Composer dentro do container
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configura a pasta pública como DocumentRoot do Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Ativa mod_rewrite do Apache
RUN a2enmod rewrite

# Variáveis globais de ambiente
ENV BROADCAST_DRIVER=log \
    REVERB_APP_ID=dummy \
    REVERB_APP_KEY=dummy \
    REVERB_APP_SECRET=dummy \
    PUSHER_APP_ID=dummy \
    PUSHER_APP_KEY=dummy \
    PUSHER_APP_SECRET=dummy

# Copia os ficheiros do projeto
COPY . /var/www/html

WORKDIR /var/www/html

# Instala dependências PHP e compila os estilos CSS/JS do Vite
RUN composer install --no-scripts --optimize-autoloader
RUN npm install && npm run build

# Garante a criação da base de dados e ajusta permissões da pasta public, storage e cache
RUN mkdir -p database && touch database/database.sqlite
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database /var/www/html/public
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database /var/www/html/public

EXPOSE 80

# Limpa a configuração, corre as migrações e inicia o Apache
CMD php artisan config:clear && php artisan migrate --force && apache2-foreground