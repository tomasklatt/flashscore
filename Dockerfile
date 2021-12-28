FROM php:8.1-cli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Install GIT for composer purposes
RUN apt-get update && apt-get install -y git zip

COPY . /usr/src/app
WORKDIR /usr/src/app

RUN composer install --dev
CMD [ "composer", "test" ]