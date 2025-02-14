#which php
#php -i|grep 'php.ini'

#sudo apt-get install php
#sudo apt-get install sockstat
#sudo apt install netcat-openbsd

ps -e
kill $(ps aux | grep '[p]hp' | awk '{print $2}')

#sockstat -l