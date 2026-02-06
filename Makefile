composer-update:
	composer update

composer-install:
	composer install

remove-composer:
	rm -rf composer.lock rm -rf vendor

test:
	make static-analysis
	make unit-tests

static-analysis:
	composer run cs:check
	composer run stan

unit-tests:
	composer run test

cs-fix: 
	composer run cs:fix
