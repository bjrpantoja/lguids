#!/bin/sh

# update ubuntu
sudo apt-get update -y
sudo apt-get upgrade -y
sudo apt-get install build-essential -y

# give user rights to shutdown/restart
sudo chmod u+s /sbin/shutdown
sudo chmod u+s /sbin/reboot

# apache
sudo apt-get install apache2 -y

# mysql
sudo apt-get install mysql-server libapache2-mod-auth-mysql php5-mysql
sudo mysql_install_db
sudo mysql_secure_installation

# php
sudo apt-get install php5 libapache2-mod-php5 php5-mcrypt
sudo php5enmod mcrypt
sudo a2enmod rewrite
sudo service apache2 restart

# copy lguids-v3 and pm to /var/web
sudo cp -R /tmp/lguids-installer/lguids-v3 /var/web
sudo cp -R /tmp/lguids-installer/pm /var/web
sudo chown -R lguids:lguids /var/web/lguids-v3
sudo chmod -R 755 /var/web/lguids-v3
sudo chmod -R 777 /var/web/lguids-v3/storage
sudo chmod -R 777 /var/web/lguids-v3/vendor
sudo chmod -R 777 /var/web/lguids-v3/public
sudo chmod -R 755 /var/web/pm

# create database and migrate seeds
mysql -u root -plguids007 -e "create database lguids_db"
cd /var/web/lguids-v3 && php artisan migrate:refresh --seed

# update 000-default.conf
sudo cp /tmp/lguids-installer/etc_apache2_sites-available/000-default.conf /etc/apache2/sites-available

# copy udev rules and restart service
sudo cp /tmp/lguids-installer/etc_udev_rules.d/1-gsm.rules /etc/udev/rules.d
sudo service udev restart
sudo udevadm trigger

# install sms monitoring module
sudo cp -R /tmp/lguids-installer/usr_local_src/lib-mm /usr/local/src && sudo chmod -R 777 /usr/local/src/lib-mm && cd /usr/local/src/lib-mm
./configure --prefix=/usr
make
make test
sudo make install

# install smstools
sudo cp -R /tmp/lguids-installer/smstools /usr/local/bin && sudo chmod -R 777 /usr/local/bin/smstools && cd /usr/local/bin
make
sudo make install
sudo update-rc.d sms3 defaults

# copy sms files
sudo cp -R /tmp/lguids-installer/var_spool_sms/* /var/spool/sms && sudo chmod -R 777 /var/spool/sms
sudo cp -R /tmp/lguids-installer/usr_local_bin/mysmsd.php /usr/local/bin && sudo chmod +x /usr/local/bin/mysmsd.php
sudo cp /tmp/lguids-installer/etc/smsd_single.conf /etc/smsd.conf

# install cron
sudo chown -R lguids:lguids /home/lguids
sudo crontab /tmp/lguids-installer/crontab.txt

# allow modem to restart
# sudo nano /etc/sudoers
# add www-data ALL=NOPASSWD:/usr/bin/service