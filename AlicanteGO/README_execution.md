# [DSS] Eloquent exercise

## Project initialization

After downloading the project execute
```shell
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:refresh
php artisan migrate --seed

http://localhost/adminer

php artisan serve

http://localhost:8000/page_name

```
