FROM php:8.3-fpm-bookworm

ENV TZ=America/Sao_Paulo
ENV DEBIAN_FRONTEND noninteractive

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update -yqq && \
    apt-get upgrade -y && \
    apt-get install -y --no-install-recommends \
    git \
    wget \
    curl \
    unzip \
    nano \
    tree \
    openssl \
    libpq-dev \
    libaio1 \
    libaio-dev \
    zlib1g-dev \
    libonig-dev \
    libzip-dev \
    libicu-dev \
    libssl-dev \
    libxml2-dev \
    libmemcached-dev \
    libbrotli-dev \
    nodejs \
    npm

RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql && \
    docker-php-ext-configure intl && \
    docker-php-ext-install \
    intl \
    zip \
    mbstring \
    pcntl \
    sockets \
    exif \
    bcmath \
    soap \
    simplexml \
    pgsql \
    pdo_pgsql

RUN pecl install \
    redis \
    apcu \
    xdebug \
    swoole && \
    docker-php-ext-enable \
    xdebug \
    redis \
    opcache \
    swoole \
    apcu && \
    pecl clear-cache

COPY php.ini /usr/local/etc/php/

RUN groupadd -g 1001 dev && \
    useradd -m -u 1001 -g dev dev && \
    usermod -a -G www-data dev

RUN curl -L -C - --progress-bar -o /usr/local/bin/composer https://getcomposer.org/composer.phar && \
    chmod 755 /usr/local/bin/composer && \
    composer self-update

RUN rm -rf /var/lib/apt/lists/*

COPY --chown=devs:www-data . /var/www

RUN chown -R www-data /var/www

USER dev:dev

WORKDIR /var/www

EXPOSE 9000
EXPOSE 9003
EXPOSE 8000

CMD ["php-fpm"]
