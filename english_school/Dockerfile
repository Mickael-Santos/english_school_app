# Use a imagem oficial do PHP com suporte ao Apache
FROM php:8.2-apache

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    curl \
    git \
    libpq-dev

# Instalar extensões PHP necessárias
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    mbstring \
    zip

# Habilitar o módulo de reescrita do Apache
RUN a2enmod rewrite

# Copiar o arquivo de configuração do Apache
COPY ./laravel.conf /etc/apache2/sites-available/laravel.conf

# Habilitar o site Laravel e desabilitar o site padrão
RUN a2ensite laravel.conf && \
    a2dissite 000-default.conf

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar todos os arquivos da aplicação para o contêiner
COPY . .

# Instalar o Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Instalar dependências do Laravel
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Gera a chave da aplicação Laravel
# RUN php artisan config:clear
# RUN php artisan config:cache
# RUN php artisan key:generate

# Ajustar permissões para o Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html

# Expor a porta do Apache
EXPOSE 80

# Comando padrão para iniciar o Apache
CMD ["apache2-foreground"]