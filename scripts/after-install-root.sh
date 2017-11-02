#!/bin/bash
cd /home/ubuntu/medscanner

cp aws/config/medscanner-nginx /etc/nginx/sites-enabled/medscanner
ln -s /etc/nginx/sites-available/medscanner /etc/nginx/sites-enable/medscanner

sed -i 's/;cgi_fixpathinfo=1/cgi_fixpathinfo=0/' /etc/php/7.0/fpm/php.ini
cp -r /home/ubuntu/medscanner /var/www/medscanner
chown -r www_data:www_data /var/www/medscanner
