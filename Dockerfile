FROM php:8.0-cli

COPY . /usr/src/app
WORKDIR /usr/src/app

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install
CMD [ "composer", "test" ]