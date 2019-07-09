up:
	sudo docker-compose up -d
kill:
	sudo docker-compose kill
down:
	sudo docker-compose down
migrate:
	sudo docker-compose exec php-fpm php artisan migrate
module-seed:
	sudo docker-compose exec php-fpm php artisan module:seed
seed:
	sudo docker-compose exec php-fpm php artisan db:seed
queue-work:
	sudo docker-compose exec php-cli php artisan queue:work
migrate-fresh:
	sudo docker-compose exec php-fpm php artisan migrate:fresh
