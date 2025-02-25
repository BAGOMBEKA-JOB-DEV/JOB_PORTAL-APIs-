# Laravel Job Portal API
SIMPLE JOB PORTAL LARAVEL API

## Features

-   Register, Login && Logout
-   Job Listing CRUD
-   Authentication & Authorization before applying to a job!!!
-   List all jobs 
-   Apply  to  a job when you need to first log in.


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

Run Vite(for front-end):

```
php artisan serve
```

Open http://localhost:8000 or any other url provided by your local machine
