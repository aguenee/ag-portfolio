#!/usr/bin/env bash

# Use single quotes instead of double quotes to make it work with special-character passwords
PASSWORD='12345678'
PROJECTFOLDER='ag-portfolio'

# Create project folder
sudo mkdir "/var/www/${PROJECTFOLDER}"

# Update / Upgrade
sudo apt-get update
sudo apt-get -y upgrade

# Install Apache 2.5 and PHP 5.5
sudo apt-get install -y apache2
#sudo apt-get install -y php5
sudo apt-add-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php7.1

# Install MySQL and give password to installer
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $PASSWORD"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $PASSWORD"
sudo apt-get -y install mysql-server
sudo apt-get install php5-mysql

# Install phpMyAdmin and give password(s) to installer
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"
sudo apt-get -y install phpmyadmin

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
sudo a2enmod rewrite

# Restart Apache
service apache2 restart

# Install Git
sudo apt-get -y install git

# Install Composer
curl -s https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Automatically cd to project dir on login
echo 'cd /var/www/ag-portfolio/' >> /home/vagrant/.bashrc
