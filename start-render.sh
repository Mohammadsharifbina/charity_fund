#!/bin/sh
set -eu

mkdir -p storage/framework/cache storage/framework/sessions \
    storage/framework/views storage/logs bootstrap/cache public/students

php artisan migrate --force --no-interaction

# Create the public storage symlink when the app uses Laravel's public disk.
php artisan storage:link --force || true

exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
