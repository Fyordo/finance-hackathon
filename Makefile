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

crud:
	docker exec -it ${APP_NAME}-php bash -c "php artisan make:model $(model) -m"
	docker exec -it ${APP_NAME}-php bash -c "php artisan make:controller $(model)Controller --api"
	docker exec -it ${APP_NAME}-php bash -c "php artisan make:request $(model)ReadRequest"
	docker exec -it ${APP_NAME}-php bash -c "php artisan make:request $(model)EditRequest"
	docker exec -it ${APP_NAME}-php bash -c "php artisan make:resource $(model)Resource"
	docker exec -it ${APP_NAME}-php bash -c "php artisan make:observer $(model)Observer"
	docker exec -it ${APP_NAME}-php bash -c "php artisan make:provider $(model)ServiceProvider"
	docker exec -it ${APP_NAME}-php bash -c "php artisan make:test $(model)Test --unit"
	docker exec -it ${APP_NAME}-php bash -c "touch app/Facades/$(model)Manager.php"
	docker exec -it ${APP_NAME}-php bash -c "touch app/Services/$(model)Service.php"
	sudo chmod 0777 -R .
