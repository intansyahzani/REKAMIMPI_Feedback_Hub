#!/bin/bash
if [ ! -d "public/storage" ]; then
    php artisan storage:link
fi

php artisan serve --host=0.0.0.0 --port=${PORT}
