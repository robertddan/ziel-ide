#which php
#php -i|grep 'php.ini'

#sudo apt-get install mariadb-server

#sudo service mysql start

sudo mysql -u root
USE mysql;
UPDATE user SET password=PASSWORD('YourNewPasswordHere') WHERE User='root' AND Host = 'localhost';
FLUSH PRIVILEGES;
quit;
#mysql -u root -p calendar < sql/calendar.sql
