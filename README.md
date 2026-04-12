# SIMPLE JOB PORTAL LARAVEL API

## 🚀 Features

- ✅ Register, Login & Logout
- 📋 Job Listing CRUD (  Authorization token required!)
- 📌 Filter job listing according to salary, category, location and job title. (  Authorization token required!)
- ✍️ Apply to a job ( Authorization token required!)
- Job applications CRUD (  Authorization  token required!)

---

## ⚙️ Usage

### 📦 Install Composer Dependencies
```bash
composer install
```

### 📝 Add .env Variables
Rename `.env.example` to `.env` and configure your database:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

###  Generate APP Key
```bash
php artisan key:generate
```

### 📂 Run Migrations
```bash
php artisan migrate
```

### 🚀 Run Server
```bash
php artisan serve
```

### 🎨 Run Vite (For Front-End (Only Register and Login))
```bash
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000) or the provided URL.

---

## 📡 API Endpoints

### 📝 Register (POST)
```http
POST http://127.0.0.1:8000/api/register
```
**Request Body:**
```json
{
    "name": "BAGOMBEKA JOB",
    "email": "user@gmail.com",
    "password": "hellomama256"
}
```
**Response:**
```json
{
    "message": "User Created Successfully"
}
```

### 🔑 Login (POST)
```http
POST http://127.0.0.1:8000/api/login
```
**Request Body:**
```json
{
    "email": "user@gmail.com",
    "password": "hellomama256"
}
```
**Response:**
```json
{
    "token": "11|ccuMPCbuWLkNia2xYR0vurPNFwuMSebqNZvzbsGLf621b5e8"
}
```

### 📌 Job Creation (POST) (Auth Required)
```http
POST http://127.0.0.1:8000/api/job-listings
```
**Request Body:**
```json
{
    "title": "Accountant",
    "description": "We are looking for a skilled accountant to join our team and work on cutting-edge projects.",
    "company": "SMSONE.",
    "location": "Kampala, Uganda",
    "salary": "700000",
    "category": "Accounting"
}
```
**Response:**
```json
{
    "title": "Accountant",
    "description": "We are looking for a skilled accountant to join our team and work on cutting-edge projects.",
    "company": "SMSONE.",
    "location": "Kampala, Uganda",
    "salary": "700000",
    "category": "Accounting",
    "updated_at": "2025-02-25T11:08:48.000000Z",
    "created_at": "2025-02-25T11:08:48.000000Z",
    "id": 3
}
```

### 📋 List All Jobs (GET)
```http
GET http://127.0.0.1:8000/api/job-listings
```
**Response:**
```json
[
    {
        "id": 1,
        "title": "Software Engineer",
        "description": "We are looking for a skilled software engineer to join our team and work on cutting-edge projects.",
        "company": "Tech Innovations Ltd.",
        "location": "Kampala, Uganda",
        "salary": 50000,
        "category": "Software Development",
        "created_at": "2025-02-25T08:35:32.000000Z",
        "updated_at": "2025-02-25T08:35:32.000000Z"
    },
    {
        "id": 2,
        "title": "Software Engineer",
        "description": "We are looking for a skilled software engineer to join our team and work on cutting-edge projects.",
        "company": "Tech Innovations Ltd.",
        "location": "Kampala, Uganda",
        "salary": 50000,
        "category": "Software Development",
        "created_at": "2025-02-25T08:35:37.000000Z",
        "updated_at": "2025-02-25T08:35:37.000000Z"
    },
    {
        "id": 3,
        "title": "Accountant",
        "description": "We are looking for a skilled accountant to join our team and work on cutting-edge projects.",
        "company": "SMSONE.",
        "location": "Kampala, Uganda",
        "salary": 700000,
        "category": "Accountanting",
        "created_at": "2025-02-25T11:08:48.000000Z",
        "updated_at": "2025-02-25T11:08:48.000000Z"
    }
]
```

### 📩 Apply to a Job (POST) (Auth Required)
```http
POST http://127.0.0.1:8000/api/apply
```
**Request Body:**
```json
{
    "job_id": "3",
    "user_id": "4",
    "cover_letter": "Hello there, I am applying for the role of accountant at your company! Thanks"
}
```
**Response:**
```json
{
    "job_id": "3",
    "user_id": "4",
    "cover_letter": "Hello there, I am applying for the role of accountant at your company! Thanks",
    "updated_at": "2025-02-25T11:20:25.000000Z",
    "created_at": "2025-02-25T11:20:25.000000Z",
    "id": 2
}
```

### 📜 List All Applications (GET)
```http
GET http://127.0.0.1:8000/api/applications
```
**Response :**
```json
[
    {
        "id": 1,
        "user_id": 2,
        "job_id": 2,
        "cover_letter": "hello there....",
        "status": "pending",
        "created_at": "2025-02-25T09:46:32.000000Z",
        "updated_at": "2025-02-25T09:46:32.000000Z"
    },
    {
        "id": 2,
        "user_id": 4,
        "job_id": 3,
        "cover_letter": "Hello there, am applying for the role of accountant at your company! Thanks",
        "status": "pending",
        "created_at": "2025-02-25T11:20:25.000000Z",
        "updated_at": "2025-02-25T11:20:25.000000Z"
    }
]
```

---

## 🔍 Filters

- **Filter by Category**: `GET http://127.0.0.1:8000/api/job-listings?category=Accounting`
- **Filter by Salary**: `GET http://127.0.0.1:8000/api/job-listings?salary=70000`
- **Filter by Location**: `GET http://127.0.0.1:8000/api/job-listings?location=Kampala`
- **Filter by job title**: `GET http://127.0.0.1:8000/api/job-listings?title=Accountant`

---

Happy Coding!!!!. Please ensure to give me credit in case you clone or fork this project. You didn't code it, I did!!!!!!

