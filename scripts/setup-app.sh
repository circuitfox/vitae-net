#!/bin/bash
# parameters 
# 1: deploy directory
# 2: migrations user password
# 3: app user password

cd $HOME

# install composer if we haven't already
if [ ! -f "$HOME/composer" ]; then
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"  
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60    ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f06    1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('com    poser-setup.php'); } echo PHP_EOL;"
    php composer-setup.php --install-dir="$HOME" --filename=composer    
    php -r "unlink('composer-setup.php');"
else
    "$HOME/composer" self-update --stable --no-interaction
fi

# set passwords for migration
cd "$1"
cp deploy/.env .env
sed -i -e "s/MIGRATE_PASSWORD=/&$2/" .env
sed -i -e "s/DB_PASSWORD=/&$3/" .env

# install composer deps and migrate
"$HOME/composer" install --no-dev --no-interaction --no-scripts --no-plugins
php artisan key:generate
php artisan migrate --database=migrate
