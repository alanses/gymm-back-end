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
build: git-reset-pull composer-install composer-update key-generate migrate-and-seed passport-install
git-reset-pull:
	git reset --hard
	git pull origin master
composer-install:
	composer install
composer-update:
	composer update
key-generate:
	php artisan key:generate
migrate-and-seed:
	php artisan migrate
	php artisan module:seed
passport-install:
	sudo docker-compose exec php-fpm php artisan passport:install
run-test:
	sudo docker-compose exec php-fpm ./vendor/bin/phpunit
