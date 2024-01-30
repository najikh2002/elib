FROM php:7.3

RUN apt-get update && apt-get install -y libpq-dev

RUN docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html/storage

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
