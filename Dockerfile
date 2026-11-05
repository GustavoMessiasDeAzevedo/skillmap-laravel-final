FROM php:8.2-apache

# Instala dependências do sistema, SQLite e Node.js
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev libsqlite3-dev zip unzip git curl \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring gd

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configura a pasta pública do Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Ativa mod_rewrite
RUN a2enmod rewrite

# Variáveis globais
ENV BROADCAST_DRIVER=log \
    SESSION_DRIVER=file \
    REVERB_APP_ID=dummy \
    REVERB_APP_KEY=dummy \
    REVERB_APP_SECRET=dummy \
    PUSHER_APP_ID=dummy \
    PUSHER_APP_KEY=dummy \
    PUSHER_APP_SECRET=dummy

COPY . /var/www/html
WORKDIR /var/www/html

# Instala pacotes PHP e compila o frontend
RUN composer install --no-scripts --optimize-autoloader
RUN npm install && npm run build

EXPOSE 80

# Cria o banco SQLite no boot e força a permissão de escrita do www-data no arquivo antes de subir o Apache
CMD mkdir -p database && touch database/database.sqlite && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database && \
    php artisan config:clear && \
    php artisan migrate --force --seed && \
    apache2-foreground