.PHONY: prod-setup
prod-setup: deps build app-key db-migrate

.PHONY: dev-setup
dev-setup: prod-setup db-seed

# Runs client in watch mode, and ngrok for local tunneling.
.PHONY: dev
dev:
	docker-compose up client caddy php-fpm db ngrok

.PHONY: logs
logs:
	tail -f storage/logs/laravel.log

# Runs the client build command first, then runs only prod required docker containers.
.PHONY: prod
prod:
	docker-compose run --rm client npm run prod
	docker-compose up -d caddy php-fpm db

.PHONY: test
test:
	docker-compose run --rm php vendor/bin/phpunit

.PHONY: deps
deps:
	docker run --rm -v ${PWD}:/app composer install

.PHONY: build
build:
	docker-compose build

.PHONY: db-migrate
db-migrate:
	docker-compose run --rm php php artisan migrate

.PHONY: db-seed
db-seed:
	docker-compose run --rm php php artisan db:seed

.PHONY: app-key
app-key:
	docker-compose run --rm php php artisan key:generate

.PHONY: docker-process-messages
docker-process-messages:
	docker-compose run --rm php php artisan schedule:run

.PHONY: docker-mysql
docker-mysql:
	docker run --network=votelocal_default -it --rm mysql mysql -hdb -uroot --password=supersecret votelocal