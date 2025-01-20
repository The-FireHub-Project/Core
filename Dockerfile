# Use PHP with Apache as the base image
FROM php:8.3-apache

# Copy the FireHub phar
COPY ./phar /var/www/html/vendor/firehub/core/phar

# Set the working directory
WORKDIR /var/www/html