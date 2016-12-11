FROM php:5-apache

MAINTAINER Luan Einhardt <ldseinhardt@gmail.com>

# Enable rewrite modules
RUN a2enmod rewrite

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb http://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

# Install git and yarn
RUN apt-get update && apt-get install -y \
    git \
    yarn \
    && docker-php-ext-install -j$(nproc) mysql mysqli pdo pdo_mysql

# Install composer and put binary into $PATH
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/ \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

# Install node.js
RUN curl -sL https://deb.nodesource.com/setup_7.x | bash - \
    && apt-get install -y nodejs build-essential

# Install bower
RUN yarn global add bower
