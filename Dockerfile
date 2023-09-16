FROM php:apache

COPY . /var/www/html

RUN a2enmod rewrite && \
  apt-get update -y && \
  apt-get install libyaml-dev -y && \
  pecl install yaml && \
  echo "extension=yaml.so" > /usr/local/etc/php/conf.d/ext-yaml.ini && \
  docker-php-ext-enable yaml && \
  mv /var/www/html/htaccess /var/www/html/.htaccess
