# Use a imagem base do PHP com Nginx
FROM php:8.3-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Copiar a configuração personalizada do Nginx para o container
COPY nginx.conf /etc/nginx/nginx.conf

# Definir o diretório do projeto como o diretório de trabalho
WORKDIR /var/www/html

# Copiar o código do projeto para o diretório de trabalho
COPY ./ /var/www/html/

# Configurar permissões para o Nginx e o PHP-FPM
RUN chown -R www-data:www-data /var/www/html

# Expor a porta 80 para o Nginx
EXPOSE 80

# Iniciar o Nginx e o PHP-FPM
CMD service nginx start && php-fpm