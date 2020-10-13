# Laravel Excel import task


## Installation 

```bash
https://github.com/ibraheemramadan/laravel-excel-task.git
```

cd repo 

```bash
docker-compose up
```

```bash
docker exec -it app /bin/bash
```

```bash
cp -i .env.example .env
```
```bash
php artisan key:generate
```

Please note to set database connection and smtp configuration in .env file 

```bash
composer update
```

```bash
php artisan migrate
```

```bash
php artisan queue:work
```

## Usage

Use [http://127.0.0.1:88](http://127.0.0.1:88) to landing page.

## For UnitTest

```bash
php artisan test
```
