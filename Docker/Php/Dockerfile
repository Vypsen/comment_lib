FROM php:8.1-fpm



RUN apt update
RUN apt upgrade -y
RUN apt install -y apt-utils
RUN apt install -y libpq-dev
RUN apt install -y postgresql-client
RUN docker-php-ext-install pgsql
RUN docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install mysqli

