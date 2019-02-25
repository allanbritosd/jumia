FROM php:7.3.2-apache

MAINTAINER Allan Brito <falecom@allanbrito.com.br>

COPY . /src

RUN chown -R www-data:www-data /src \
    && a2enmod rewrite