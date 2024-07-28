#!/usr/bin/env bash

set -e

frankenphp php-cli artisan config:cache

# WARNING: do not use in production
frankenphp php-cli artisan migrate --force --isolated --ansi

frankenphp run --config /etc/caddy/Caddyfile --adapter caddyfile
