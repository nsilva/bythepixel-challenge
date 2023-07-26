#!/bin/bash

set -Eeuo pipefail

composer install --optimize-autoloader \
    && php artisan cache:clear \
    && php artisan config:clear \
    && php artisan view:clear \
    && php artisan migrate \
    && php artisan db:seed \
    && php artisan test

echo "Setting up Laravel Scheduler..."
cp crontab/cron /etc/cron.d/container_cronjob \
    && chmod 0644 /etc/cron.d/container_cronjob \
    && touch /var/log/cron.log \
    && crontab /etc/cron.d/container_cronjob \
    && cron

echo "Dispatching weather data request..."
php artisan weather:update

echo "Starting queue..."
php artisan queue:work --tries=3
