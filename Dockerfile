# Use an official PHP runtime
FROM php:8.2-apache

# Enable Apache modules
RUN a2enmod rewrite

# Update package list and install the PostgreSQL development files
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql

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

# Run composer install and npm install
RUN composer install
RUN npm install

CMD ["apache2-foreground"]