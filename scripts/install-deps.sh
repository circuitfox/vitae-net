#!/bin/bash
set -ev

# install dependencies
yum install -y centos-release-scl.noarch epel-release.noarch
yum install -y rh-git29 rh-php71 rh-php71-php-cli rh-php71-php-fpm rh-php71-php-json rh-php71-php-mbstring rh-php71-php-mysqlnd rh-php71-php-xml rh-php71-php-gd
scl enable rh-git29 bash
# symlink php
if [ ! -e /usr/bin/php ]; then
    ln -s /opt/rh/rh-php71/root/bin/php /usr/bin/php
fi

exit 0
