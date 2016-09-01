 sudo yum install php70w-xml.x86_64
 sudo yum install hp70w-mcrypt.x86_64

sudo php -S 0:80 -t web/ run app

composer install

sudo vim /etc/init.d/startup.sh

vendor/bin/phinx rollback - migration

vendor/bin/phpunit - untesting
