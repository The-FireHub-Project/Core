FROM php:8.3-apache

COPY ./phar /var/www/html/vendor/firehub/core/phar

WORKDIR /var/www/html