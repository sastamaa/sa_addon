# Use the official PHP image
FROM php:8.1-apache

# Enable Apache Rewrite Module
RUN a2enmod rewrite

# Copy your code to the server directory
COPY . /var/www/html/

# Set permissions for the copied files
RUN chown -R www-data:www-data /var/www/html

# Expose Apache's default port
EXPOSE 80

# Start Apache when the container runs
CMD ["apache2-foreground"]
