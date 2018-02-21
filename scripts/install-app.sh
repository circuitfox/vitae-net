#!/bin/sh
set -ev

systemctl stop rh-php71-php-fpm
systemctl stop nginx

# fix php configs
sed -i -e 's/;cgi\.fix_pathinfo=1/cgi.fix_pathinfo=0/' /etc/opt/rh/rh-php71/php.ini
sed -i -e 's|listen = 127.0.0.1:9000|listen = /run/php-fpm/www.sock|' /etc/opt/rh/rh-php71/php-fpm.d/www.conf
sed -i -e 's/;listen.acl_users = apache/listen.acl_users = nginx/' /etc/opt/rh/rh-php71/php-fpm.d/www.conf
sed -i -e 's/user = apache/user = nginx/' /etc/opt/rh/rh-php71/php-fpm.d/www.conf
sed -i -e 's/group = apache/group = nginx/' /etc/opt/rh/rh-php71/php-fpm.d/www.conf

# copy nginx config and app
/usr/bin/cp -u /home/git/vitae-net-build/deploy/nginx.conf /etc/nginx/nginx.conf
chown root:root /etc/nginx/nginx.conf
mkdir -p /var/www
/usr/bincp -ruf /home/git/vitae-net-build /var/www/
chown -R nginx:nginx /var/www/vitae-net
chmod 755 /var/www/vitae-net/storage/logs
chmod 664 /var/www/vitae-net/storage/logs/*

# selinux permissions
chcon -Rt httpd_sys_content_t /var/www/vitae-net
semanage fcontext -a -t httpd_sys_rw_content_t "/var/www/vitae-net/storage(/.*)?"
semanage fcontext -a -t httpd_sys_rw_content_t "/var/www/vitae-net/bootstrap/cache(/.*)?"
restorecon -Rv /var/www/vitae-net/storage
restorecon -Rv /var/www/vitae-net/boostrap/cache

systemctl start nginx
systemctl start rh-php71-php-fpm

exit 0
