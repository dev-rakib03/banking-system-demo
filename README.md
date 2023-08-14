Note: Components version
```
PHP 8.2.4
Composer version 2.5.8
Laravel: 10.10
```

First clone this repository
```
git clone git@github.com:dev-rakib03/banking-system-demo.git
```
or 

download manually

Install the dependencies, and setup your .env file.

```
composer install
cp .env.example .env
```

Then create database connections into ``` .env ``` file.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=banking_system_demo
DB_USERNAME=root
DB_PASSWORD=
```
Generate key.
```
php artisan key:generate
```

run the initial migrations and seeders.
```
php artisan migrate
```

run the project.
```
php artisan serve
```
brows project with this link.
```
http://localhost:8000
```
