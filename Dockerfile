# Use an official PHP runtime
FROM php:8.2-apache

# Enable Apache modules
RUN a2enmod rewrite

# Update package list and install the PostgreSQL development files
<<<<<<< HEAD
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql

=======
RUN apt-get update && apt-get install -y libpq-dev zip npm \
    && docker-php-ext-install pdo_pgsql 
>>>>>>> 4a86d8c3b204b733ff24b0c188b427ebfa31684d
# Install the pgsql extension
RUN docker-php-ext-install pgsql

# Install composer
RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Install Node.js and npm
RUN apt-get install -y nodejs npm

# Set ServerName to suppress Apache warnings
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf
RUN awk '/<Directory \/var\/www\/>/,/\/Directory>/ { if($0 ~ "AllowOverride None") { sub("None", "All"); } }1' /etc/apache2/apache2.conf > temp && mv temp /etc/apache2/apache2.conf

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the source code in /www into the container at /var/www/html
COPY . .

<<<<<<< HEAD
# Run composer install and npm install
RUN composer install
RUN npm install
=======
ARG COMPOSER_ALLOW_SUPERUSER=1
RUN composer install
run npm install

>>>>>>> 4a86d8c3b204b733ff24b0c188b427ebfa31684d

CMD ["apache2-foreground"]