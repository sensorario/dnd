test:
	./bin/phpunit

install:
	composer install

coverage:
	./bin/phpunit --coverage-html /tmp/coverage
	open /tmp/coverage/index.html

agile:
	./bin/phpunit --testdox
