install:
	composer install
test:
	./bin/phpunit
coverage:
	./bin/phpunit --coverage-html /tmp/coverage
	open /tmp/coverage/index.html
agile:
	./bin/phpunit --testdox
