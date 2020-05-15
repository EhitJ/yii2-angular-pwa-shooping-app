FROM php:7.2-fpm

MAINTAINER jitendra.yadav@evolutionco.com

RUN apt-get update && apt-get install -y \
libfreetype6-dev \
libjpeg62-turbo-dev \
libpng-dev \
libzip-dev \
zip \
&& docker-php-ext-install -j$(nproc) iconv \
&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
&& docker-php-ext-install -j$(nproc) gd \
&& docker-php-ext-configure zip --with-libzip \
&& docker-php-ext-install zip

RUN docker-php-ext-install pdo_mysql pdo mysqli

