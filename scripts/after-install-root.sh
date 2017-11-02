#!/bin/bash
cd /home/ubuntu/medscanner

cp aws/config/medscanner-nginx /etc/nginx/sites-enabled/medscanner
ln -s -f /etc/nginx/sites-enabled/medscanner /etc/nginx/sites-available/medscanner

sed -i 's/;cgi_fixpathinfo=1/cgi_fixpathinfo=0/' /etc/php/7.0/fpm/php.ini
rm -rf /var/www/medscanner
cp -r /home/ubuntu/medscanner /var/www/medscanner
chown -R www-data:www-data /var/www/medscanner
