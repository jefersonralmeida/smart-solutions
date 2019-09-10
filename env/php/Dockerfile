FROM php:7.2-fpm

# apt-get update
RUN apt-get update

# install the php extensions
RUN apt-get install -y libpq-dev libzip-dev unzip librdkafka-dev libzookeeper-mt-dev libpng-dev libxml2-dev --no-install-recommends && \
    docker-php-ext-install \
        pdo \
        pdo_mysql \
        zip \
        gd \
        soap


# install xdebug
RUN pecl install xdebug; \
    docker-php-ext-enable xdebug;

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"; \
    php -r "copy('https://composer.github.io/installer.sig', 'composer.sig');"; \
    php -r "if (hash_file('SHA384', 'composer-setup.php') === file_get_contents('composer.sig')) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"; \
    php composer-setup.php; \
    php -r "unlink('composer-setup.php');"; \
    php -r "unlink('composer.sig');"; \
    mv composer.phar /usr/local/bin/composer;


