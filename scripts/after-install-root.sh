#!/bin/bash
cd /home/ubuntu/medscanner

cp aws/config/medscanner-nginx /etc/nginx/sites-available/medscanner
if [ ! -f /etc/nginx/sites-enabled/medscanner ]; then
    ln -s /etc/nginx/sites-available/medscanner /etc/nginx/sites-enabled/medscanner
fi

sed -i 's/;cgi_fixpathinfo=1/cgi_fixpathinfo=0/' /etc/php/7.0/fpm/php.ini
cp -r /home/ubuntu/medscanner /var/www/medscanner
chown -R www-data:www-data /var/www/medscanner
