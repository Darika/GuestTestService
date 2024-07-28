FROM composer:2.7.7 AS vendor

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader
#    --no-dev


FROM dunglas/frankenphp:1.2.2-php8.2

EXPOSE 8080

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_pgsql opcache

ARG USER=www-data
ENV SERVER_NAME=:8080
ENV APP_ENV=production

RUN \
	useradd -D ${USER}; \
	setcap -r /usr/local/bin/frankenphp; \
	chown -R ${USER}:${USER} /data/caddy && chown -R ${USER}:${USER} /config/caddy

COPY --from=vendor /app/vendor/ ./vendor
COPY . .

RUN frankenphp php-cli artisan route:cache

RUN chown -R ${USER}:${USER} /app/bootstrap/cache /app/storage
RUN chmod +x /app/.docker/docker_entrypoint.sh

USER ${USER}
CMD ["bash", "-c", "/app/.docker/docker_entrypoint.sh"]
