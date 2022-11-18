#!make
include .env

up:
	docker-compose up -d
	docker exec -it ${APP_NAME}-nginx bash -c "chmod -R guo+w /var/www/storage"

down:
	docker-compose down

console:
	docker exec -it ${APP_NAME}-php bash

tests:
	docker exec -it ${APP_NAME}-php bash -c "phpunit"
