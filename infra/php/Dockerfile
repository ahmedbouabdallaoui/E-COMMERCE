FROM php:8.3-fpm

ARG BUILD_ARGUMENT_ENV=dev
ENV APP_HOME /var/www/html

RUN apt-get update && apt-get upgrade -y && apt-get install -y \
      bash-completion \
      fish \
      procps \
      nano \
      git \
      unzip \
      libicu-dev \
      zlib1g-dev \
      libxml2 \
      libxml2-dev \
      libreadline-dev \
      supervisor \
      cron \
      sudo \
      libzip-dev \
      wget \
      librabbitmq-dev \
    && pecl install amqp \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
      pdo_mysql \
      sockets \
      intl \
      opcache \
      zip \
    && docker-php-ext-enable amqp \
    && rm -rf /tmp/* \
    && rm -rf /var/list/apt/* \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN chmod +x /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN composer completion bash > /etc/bash_completion.d/composer

WORKDIR $APP_HOME

RUN mkdir -p /usr/src/php/ext/apcu && \
    curl -fsSL https://pecl.php.net/get/apcu | tar xvz -C "/usr/src/php/ext/apcu" --strip 1 && \
    docker-php-ext-install apcu

RUN pecl install xdebug-3.3.1 && \
    docker-php-ext-enable xdebug

RUN echo "deb http://security.debian.org/debian-security bullseye-security main contrib non-free" > /etc/apt/sources.list && \
    apt-get update && apt-get upgrade -y

RUN apt-get install -y git libxslt-dev libldap2-dev libssl-dev

USER root
