FROM php:7.2-apache

#set the working directory to /var/www/html
WORKDIR /var/www/html

#enable rewrite
RUN a2enmod rewrite && service apache2 restart

#install the MariaDB PHP connector
RUN apt-get update && apt-get install -y mariadb-client libmariadb-dev
RUN docker-php-ext-install mysqli pdo pdo_mysql

#copy the contents of the local directory into the container
COPY . .

#expose port 80
EXPOSE 80