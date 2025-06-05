FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    curl \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-error.ini \
    && echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-error.ini \
    && echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-error.ini \
    && echo "log_errors = On" >> /usr/local/etc/php/conf.d/docker-php-error.ini \
    && echo "error_log = /var/log/php_errors.log" >> /usr/local/etc/php/conf.d/docker-php-error.ini

WORKDIR /var/www/html

COPY . /var/www/html/

RUN composer install --no-dev --optimize-autoloader

RUN mkdir -p public/uploads && chmod -R 777 public/uploads

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80

CMD ["apache2-foreground"]