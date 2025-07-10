#!/bin/bash

# Ensure symlink exists
ln -s -f /app/storage/app/public /app/public/storage

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=${PORT}
