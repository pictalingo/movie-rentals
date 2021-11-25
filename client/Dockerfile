FROM php:8.0-apache

RUN a2enmod proxy
RUN a2enmod proxy_http

COPY 000-default.conf /etc/apache2/sites-available/

EXPOSE 80
