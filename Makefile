.PHONY: setup dev  prod test deps build db-mgirate app-key

prod-setup: deps build app-key db-migrate

dev-setup: prod-setup db-seed

# Runs client in watch mode, and ngrok for local tunneling.
dev:
	docker-compose up client caddy php-fpm db ngrok

# Runs the client build command first, then runs only prod required docker containers.
prod:
	docker-compose run --rm client npm run prod
	docker-compose up -d caddy php-fpm db

test:
	docker-compose run --rm php vendor/bin/phpunit

deps:
	docker run --rm -v ${PWD}:/app composer install

build:
	docker-compose build

db-migrate:
	docker-compose run --rm php php artisan migrate

db-seed:
	docker-compose run --rm php php artisan db:seed

app-key:
	docker-compose run --rm php php artisan key:generate

docker-process-messages:
	docker-compose run --rm php php artisan schedule:run

docker-mysql:
	docker run --network=votelocal_default -it --rm mysql mysql -hdb -uroot --password=supersecret votelocal