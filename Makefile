install:
	composer install

run: install
	php artisan qanda:interactive


test: install
	php vendor/bin/phpunit

clear: install
	php artisan qanda:reset
