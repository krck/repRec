#!/bin/bash

cd /var/www/repRec

# Pull latest changes
git pull #--rebase

# Migrate database
php artisan migrate --force

# Install and build dependencies
npm install
npm run build

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize

# Restart nginx and the postgres
sudo systemctl restart nginx
echo 'nginx restarted'
sudo systemctl restart postgresql
echo 'postgresql restarted'
