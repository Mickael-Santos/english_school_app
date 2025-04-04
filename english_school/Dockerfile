# Usa a imagem oficial do PHP com suporte ao Apache
FROM php:8.2-apache

# Instala as dependências do sistema
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    curl \
    git \
    libpq-dev

# Instala as extensões PHP necessárias
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    mbstring \
    zip

# Habilita o módulo de reescrita do Apache
RUN a2enmod rewrite

# Copia o arquivo de configuração do Apache laravel.conf
COPY ./laravel.conf /etc/apache2/sites-available/laravel.conf

# Habilita o site Laravel e desabilita o site padrão
RUN a2ensite laravel.conf && \
    a2dissite 000-default.conf

# Defini o diretório de trabalho
WORKDIR /var/www/html

# Copia todos os arquivos da aplicação para o contêiner
COPY . .

# Instala o Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Instala as dependências do Composer e as do Laravel
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Gera a chave da aplicação Laravel
RUN php artisan config:clear
RUN php artisan config:cache
RUN php artisan key:generate

# Ajusta as permissões para o Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html

# Expoe a porta do Apache
EXPOSE 80

# Comando padrão para iniciar o Apache
CMD ["apache2-foreground"]