FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    curl \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . /var/www/html/

RUN composer install --no-dev --optimize-autoloader

RUN mkdir -p public/uploads && chmod -R 777 public/uploads

EXPOSE 80

CMD ["apache2-foreground"]