.PHONY: build up down install init test sh reinstall test_clean

ifeq (test_group,$(firstword $(MAKECMDGOALS)))
  # use the rest as arguments for "test_group"
  RUN_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
  # ...and turn them into do-nothing targets
  $(eval $(RUN_ARGS):;@:)
endif

build:
	docker compose build

up:
	docker compose up -d

down:
	docker compose down --volumes --remove-orphans

install:
	docker compose run --rm php composer install -d /var/www
	docker compose run --rm php php /var/www/init --env=Development --overwrite=All

test_group:
	docker compose exec php vendor/bin/codecept run -g $(RUN_ARGS)

test_clean:
	rm -rf tests/_output/*
	rm -rf vendor/
	rm -f composer.lock

reinstall: test_clean down build up install