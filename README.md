# Discount. Backend for Russian app

### Install
Run commands:
```
cd docker && docker-compose up -d
```

In docker container:
```
cp .env.example .env (setting db connection)
composer install
php artisan migrate
```
### Run tests
Run command in docker container:
```
./vendor/bin/phpunit
```
