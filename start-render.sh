#!/bin/sh
set -eu

# The free demo uses temporary SQLite storage; data is not durable.
if [ ! -f .env ]; then
    cp .env.example .env
fi

if ! grep -q '^APP_KEY=base64:' .env; then
    php artisan key:generate --force --no-interaction
fi

mkdir -p storage/framework/cache storage/framework/sessions \
    storage/framework/views storage/logs bootstrap/cache public/students
mkdir -p /tmp
touch "${DB_DATABASE:-/tmp/charity.sqlite}"

php artisan migrate --force --no-interaction

php artisan storage:link --force || true

exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
