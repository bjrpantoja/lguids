#!/bin/sh

# update ubuntu
sudo apt-get update -y
sudo apt-get upgrade -y
sudo apt-get install build-essential -y

# give user rights to shutdown/restart
sudo chmod u+s /sbin/shutdown
sudo chmod u+s /sbin/reboot

# apache
sudo apt-get install php5-cli
sudo apt-get install apache2 -y

# install composer
(cd ~; curl -s http://getcomposer.org/installer | php) 
sudo mv ~/composer.phar /usr/local/bin
alias composer='/usr/local/bin/composer.phar'


# mysql
sudo apt-get install mysql-server libapache2-mod-auth-mysql php5-mysql
sudo mysql_install_db
sudo mysql_secure_installation

# php
sudo apt-get install php5 libapache2-mod-php5 php5-mcrypt
sudo php5enmod mcrypt
sudo a2enmod rewrite
sudo service apache2 restart

# copy/create files and folders required for installation
sudo mkdir /var/web
sudo cp -R /var/web/lguids/tools/lib-mm /usr/local/src
sudo cp -R /var/web/lguids/tools/smstools /usr/local/src
sudo cp -R /var/web/lguids/tools/pm /var/web
sudo cp -R /var/web/lguids/tools/sms /var/spool
sudo cp /var/web/lguids/tools/etc/smsd.conf /etc
sudo cp /var/web/lguids/tools/udev/1-gsm.rules /etc/udev/rules.d
sudo cp /var/web/lguids/tools/.ssh ~/
sudo cp /var/web/lguids/tools/apache2/000-default.conf /etc/apache2/sites-available

# change file permission of folders
sudo chmod -R 777 /usr/local/src/lib-mm
sudo chmod -R 777 /usr/local/src/smstools
sudo chmod -R 777 /var/spool/sms

# install lib-mm for sms monitoring and smstools for sms module
(cd /usr/local/src/lib-mm; ./configure --prefix=/usr; sudo make; sudo make test; sudo make install; sudo make clean smsd)
(cd /usr/local/src/smstools; sudo make; sudo make install; sudo update-rc.d sms3 defaults)

# restart services
sudo service udev restart
sudo udevadm trigger
sudo service sms3 restart
sudo apache2 restart

# install laravel packages
(cd /var/web/lguids; composer install --prefer-dist)
(cd /var/web/lguids; php artisan optimize)

# create database
mysql -u root -plguids007 < /var/web/lguids/tools/lguidsuser.sql

# run migration and seeders
(cd /var/web/lguids; php artisan migrate:refresh --seed)

crontab /var/web/lguids/tools/crontab.txt