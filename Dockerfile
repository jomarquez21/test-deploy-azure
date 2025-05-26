# syntax=docker/dockerfile:1

FROM public.ecr.aws/docker/library/php:8.3.7-apache-bookworm AS base

COPY --from=public.ecr.aws/docker/library/composer:2.8.2 /usr/bin/composer /usr/bin/composer

# Instala Composer y dependencias de Symfony
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    git \
    libicu-dev 

# Instala Symfony CLI
# RUN curl -sS https://get.symfony.com/cli/installer | bash \
#     && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Install "azure-cli" package.
# See: https://learn.microsoft.com/en-us/cli/azure/install-azure-cli-linux?pivots=apt#option-1-install-with-one-command.
# RUN curl -sL https://raw.githubusercontent.com/Azure/azure-cli/azure-cli-2.52.0/scripts/release/debian/deb_install.sh | bash

# Reset default "/bin/sh" flags.
SHELL ["/bin/sh", "-c"]

# Define el directorio de trabajo
WORKDIR /app
