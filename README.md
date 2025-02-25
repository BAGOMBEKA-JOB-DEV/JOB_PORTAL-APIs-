# Laravel Job Portal API

This is a job listing api built with Laravel 11

## Features

-   Job Listing CRUD
-   Authentication & Authorization Policies
-   Apply to jobs listed

## Usage

#### Install composer dependencies

```
composer install
```

#### Add .env Variables

Rename the `.env.example` file to `.env` and add your database values. Change driver and port as needed.

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

#### Run Migrations

```
php artisan migrate
```

#### Run Server

Run:

```
php artisan serve
```

Open http://localhost:8000
