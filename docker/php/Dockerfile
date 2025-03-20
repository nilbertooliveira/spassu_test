# Imagem base PHP 8.4 + Alpine
FROM php:8-fpm-alpine

# Atualizar os pacotes do sistema
RUN apk update && apk upgrade

# Instalar dependências para extensões do PHP relacionadas ao sistema
RUN apk add --no-cache \
    bash \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    libzip-dev \
    postgresql-dev \
    oniguruma-dev \
    autoconf \
    g++ \
    make \
    linux-headers \
    curl \
    nodejs \
    npm

# Configurar e instalar a extensão GD
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp
RUN docker-php-ext-install gd

# Instalar extensões PHP adicionais
RUN docker-php-ext-install \
    mbstring \
    pdo_pgsql \
    pdo_mysql \
    zip

# Instalar e configurar a extensão Redis via PECL
RUN pecl install redis \
    && docker-php-ext-enable redis

# Instalar e configurar o Xdebug via PECL
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Atualizar npm para a versão mais recente
RUN npm install -g npm@latest

# Remover ferramentas utilizadas durante o build
RUN apk del autoconf g++ make linux-headers

# Limpar cache para reduzir tamanho da imagem
RUN rm -rf /var/cache/apk/* /tmp/* /usr/src/php

# Configurar diretório de trabalho
WORKDIR /var/www/html

# Expor as portas necessárias
EXPOSE 9000 9003 5173

# Configurar o comando padrão
CMD ["php-fpm"]
