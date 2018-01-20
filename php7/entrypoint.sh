#!/bin/sh
set -e

if [ "$1" == "php-fpm" ]; then
   chown -R www:www /app
fi

exec "$@"
