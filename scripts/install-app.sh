#!/bin/sh
set -ev

systemctl stop rh-php71-php-fpm
systemctl stop nginx
systemctl stop redis
if systemctl is-active laravel-echo-server; then
    systemctl stop laravel-echo-server
fi
if systemctl is-active vitae-net-queue; then
    systemctl stop vitae-net-queue
fi

# fix php configs
sed -i -e 's/;cgi\.fix_pathinfo=1/cgi.fix_pathinfo=0/' /etc/opt/rh/rh-php71/php.ini
sed -i -e 's|listen = 127.0.0.1:9000|listen = /run/php-fpm/www.sock|' /etc/opt/rh/rh-php71/php-fpm.d/www.conf
sed -i -e 's/;listen.acl_users = apache/listen.acl_users = nginx/' /etc/opt/rh/rh-php71/php-fpm.d/www.conf
sed -i -e 's/user = apache/user = nginx/' /etc/opt/rh/rh-php71/php-fpm.d/www.conf
sed -i -e 's/group = apache/group = nginx/' /etc/opt/rh/rh-php71/php-fpm.d/www.conf

# copy nginx config, systemd units, and app
/usr/bin/cp -u /home/git/vitae-net-build/deploy/nginx.conf /etc/nginx/nginx.conf
/usr/bin/cp -u /home/git/vitae-net-build/deploy/laravel-echo-server.service /usr/lib/systemd/system
/usr/bin/cp -u /home/git/vitae-net-build/deploy/vitae-net-queue.service /usr/lib/systemd/system
chown root:root /etc/nginx/nginx.conf
chown root:root /usr/lib/systemd/system/laravel-echo-server.service
chown root:root /usr/lib/systemd/system/vitae-net-queue.service
mkdir -p /var/www
/usr/bin/cp -ruf /home/git/vitae-net-build/. /var/www/vitae-net
cd /var/www/vitae-net
php artisan storage:link
chown -R nginx:nginx /var/www/vitae-net
chmod 755 /var/www/vitae-net/storage/logs
chmod 664 /var/www/vitae-net/storage/logs/*

# selinux permissions
chcon -Rt httpd_sys_content_t /var/www/vitae-net
setsebool httpd_can_network_connect_db 1
setsebool httpd_can_network_connect 1
semanage fcontext -a -t httpd_sys_rw_content_t "/var/www/vitae-net/storage(/.*)?"
semanage fcontext -a -t httpd_sys_rw_content_t "/var/www/vitae-net/bootstrap/cache(/.*)?"
restorecon -Riv /var/www/vitae-net/storage
restorecon -Riv /var/www/vitae-net/boostrap/cache

systemctl start nginx
systemctl start rh-php71-php-fpm
systemctl start redis
systemctl start laravel-echo-server
systemctl start vitae-net-queue

exit 0
