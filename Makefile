init: up \
	composer-install

up:
	docker compose up -d

down:
	docker compose down

build:
	docker compose build

composer-install:
	docker compose run --rm app composer install