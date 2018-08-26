FROM php:7.2-fpm

COPY . /var/www/SMS_Sender
RUN chown -R www-data:www-data /var/www/SMS_Sender/storage
ADD Docker/vhost.conf /etc/nginx/conf.d/default.conf
WORKDIR /var/www/SMS_Sender