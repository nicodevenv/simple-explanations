install:
	composer install
	bin/console doc:mig:mig -n
	bin/console server:run

clean:
	bin/console doc:dat:drop --force

reinstall: clean install
