.PHONY: build up down install init test sh reinstall test_clean

build:
	docker-compose build

up:
	docker-compose up -d

down:
	docker-compose down --volumes --remove-orphans

install:
	docker-compose run --rm php composer install -d /var/www
	docker-compose run --rm php php /var/www/init --env=Development --overwrite=All

test:
	docker-compose run --rm php vendor/bin/codecept run -d /var/www

sh:
	docker-compose exec php sh

test_clean:
	rm -rf tests/_output/*
	rm -rf vendor/
	rm -f composer.lock

reinstall: test_clean down build up install