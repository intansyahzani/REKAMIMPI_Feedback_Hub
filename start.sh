#!/bin/bash
php artisan storage:link
php artisan migrate --force
php artisan serve --host=0.0.0.0 --port=${PORT}
