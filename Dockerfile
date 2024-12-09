# syntax=docker/dockerfile:1

FROM public.ecr.aws/docker/library/php:8.3.7-apache-bookworm

COPY --from=public.ecr.aws/docker/library/composer:2.8.2 /usr/bin/composer /usr/bin/composer

# Instala Composer y dependencias de Symfony
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    && docker-php-ext-install intl

# Instala Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Define el directorio de trabajo
WORKDIR /app
