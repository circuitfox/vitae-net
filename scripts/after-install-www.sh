#!/bin/bash

cd /home/ubuntu/medscanner

composer install --quiet --no-ansi --no-dev --no-interaction --no-scripts --no-plugins --no-progress

cp /etc/medscanner/env .env
php artisan key:generate
php artisan migrate --database=migrate

npm install
npm run dev
rm -rf node_modules/
