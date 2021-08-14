FROM php:8.0.9-fpm

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libjpeg-dev \
    libpng-dev \
    libxslt-dev \
    libpq-dev \
    exim4-daemon-light \
    git \
    nginx \
    procps \
    supervisor \
    unzip \
    nano

RUN docker-php-ext-install \
        opcache \
        pdo \
        pdo_mysql \
        mysqli \
        bcmath \
        intl \
        pcntl

RUN apt purge -y $PHPSIZE_DEPS \
    && apt autoremove -y --purge \
    && apt clean all

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && ln -s $(composer config --global home) /root/composer
ENV PATH=$PATH:/root/composer/vendor/bin COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /application
RUN chown -R www-data:www-data /application
RUN chown -R www-data:www-data /var
USER www-data
COPY --chown=www-data:www-data . .

USER root

COPY docker/conf/php.ini $PHP_INI_DIR/php.ini
RUN rm /usr/local/etc/php-fpm.d/* && chown -R www-data:www-data /usr/local/etc/php/conf.d
COPY docker/conf/fpm.conf /usr/local/etc/php-fpm.d/www.conf

RUN rm /etc/nginx/nginx.conf && chown -R www-data:www-data /var/www/html /run /var/lib/nginx /var/log/nginx
COPY docker/conf/nginx.conf /etc/nginx/nginx.conf
COPY docker/conf/supervisord.conf /docker/conf/supervisord.conf

USER www-data

EXPOSE 8080

ENTRYPOINT [ "bash", "/application/entrypoint.sh" ]