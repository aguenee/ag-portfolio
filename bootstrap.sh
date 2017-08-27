#!/usr/bin/env bash

# Add the vagrant user to the www-data group
usermod -a -G www-data vagrant

# Use single quotes instead of double quotes to make it work with special-character passwords
PASSWORD='12345678'
PROJECTFOLDER='ag-portfolio'

# Create project folder if it doesn't exist
[ ! -d "/var/www/${PROJECTFOLDER}" ] && mkdir -p "/var/www/${PROJECTFOLDER}"

# Update / Upgrade
apt-get update
apt-get -y upgrade

# Install Apache 2.5 and PHP 5.5
apt-get install -y apache2
apt-add-repository ppa:ondrej/php
apt-get update
apt-get install php7.1

# Install MySQL and give password to installer
debconf-set-selections <<< "mysql-server mysql-server/root_password password $PASSWORD"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $PASSWORD"
apt-get -y install mysql-server
apt-get install php5-mysql

# Install phpMyAdmin and give password(s) to installer
debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $PASSWORD"
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $PASSWORD"
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $PASSWORD"
debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"
apt-get -y install phpmyadmin

# Setup hosts file
VHOST=$(cat <<EOF
<VirtualHost *:80>
    DocumentRoot "/var/www/${PROJECTFOLDER}"
    <Directory "/var/www/${PROJECTFOLDER}">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF
)
echo "${VHOST}" > /etc/apache2/sites-available/000-default.conf

# Enable mod_rewrite
a2enmod rewrite

# Restart Apache
service apache2 restart

# Install Git
apt-get -y install git

# Install node and npm
apt-get -y install node
apt-get install nodejs-legacy
apt-get -y install npm

# Install Composer
curl -s https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Automatically cd to project dir on login
echo 'cd /var/www/ag-portfolio/' >> /home/vagrant/.bashrc
