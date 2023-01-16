FROM php:7.4.25-apache
#
# Update APT
RUN apt-get update
# Install compile dependency
RUN apt -y install gcc make autoconf libc-dev g++ pkg-config vim libmcrypt-dev zlib1g-dev libzip-dev unzip
RUN docker-php-ext-install pdo pdo_mysql mysqli zip
# Enable apache rewrite
#
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
#
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Enable environment module
RUN a2enmod rewrite
RUN a2enmod env
RUN a2enmod headers
#
RUN mkdir /var/www/html/usps
#
COPY . /var/www/html/usps
#
RUN chown -R www-data:www-data /var/www/html/usps
#
WORKDIR /var/www/html/usps