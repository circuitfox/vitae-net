#!/bin/bash

cd /home/ubuntu

if [ -d "$HOME/.nvm" ]; then
    #install nvm and node
    wget -qO- https://raw.githubusercontent.com/creationix/nvm/v0.33.6/install.sh | bash
    source '$HOME/.bashrc'
    nvm install 8.7.0
fi

cd /home/ubuntu/medscanner

composer install --quiet --no-ansi --no-dev --no-interaction --no-scripts --no-plugins --no-progress

cp /etc/medscanner/env .env
php artisan key:generate
php artisan migrate --database=migrate

npm install
npm run dev
rm -rf node_modules/
