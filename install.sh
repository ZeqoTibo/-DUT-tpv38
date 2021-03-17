# sudo apt-get install -y software-properties-common
# sudo add-apt-repository ppa:ondrej/php
# sudo apt-get update
# sudo apt-get install php5.6-cli
# sudo apt-get install php5.6-mysql
# sudo apt-get install php5.6-sqlite
# sudo apt-get install php5.6-curl
# sudo apt-get install php5.6-xml
# chmod +x ./install.sh
# chmod +x ./serverRun.sh
# chmod +x ./cacheClear.sh
export USERPROFILE=${HOME}/
php composer.phar config cache-dir --unset
php composer.phar config cache-dir ${USERPROFILE}symfony/cache
php composer.phar config vendor-dir --unset
php composer.phar config vendor-dir ${USERPROFILE}symfony/vendor
php composer.phar config bin-dir --unset
php composer.phar config bin-dir ${USERPROFILE}symfony/bin
php composer.phar install
