<<<<<<< HEAD
# laravel-backend-it15
FINAL PROJECT FOR IT15/L - 4616
=======
# University of Davao del Norte Academic Dashboard API

School Year 2025–2026

## Overview

This is the Laravel RESTful API backend for the IT15/L Integrative Programming Final Project. It provides authentication, student/course/dashboard data, and supports the React frontend dashboard.

## Features

- Laravel Sanctum token-based authentication
- Login / logout / current user endpoints
- 500 seeded student records across 20 courses
- School days and attendance data for SY 2025–2026
- Dashboard analytics endpoints (enrollment trends, demographics, attendance patterns)
- API Resources for consistent JSON responses
- Form Request validation

## Technologies Used

- Laravel 12
- PHP 8.2+
- MySQL
- Laravel Sanctum
- Faker (for database seeding)
- Composer

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── CourseController.php
│   │   ├── DashboardController.php
│   │   ├── StudentController.php
│   │   └── WeatherController.php
│   ├── Requests/
│   │   └── LoginRequest.php
│   └── Resources/
│       ├── CourseResource.php
│       └── StudentResource.php
├── Models/
│   ├── Course.php
│   ├── SchoolDay.php
│   ├── Student.php
│   └── User.php
database/
├── migrations/
└── seeders/
    ├── CourseSeeder.php
    ├── DatabaseSeeder.php
    ├── SchoolDaySeeder.php
    ├── StudentSeeder.php
    └── UserSeeder.php
routes/
└── api.php
```

## Setup Instructions

### 1. Clone the repository

```bash
git clone <your-repository-link>
cd laravel-backend
```

### 2. Install dependencies

```bash
composer install
```

### 3. Copy environment file

```bash
cp .env.example .env
```

### 4. Configure database

Edit `.env` and set:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uddn_dashboard
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Run migrations and seeders

```bash
php artisan migrate:fresh --seed
```

### 7. Start the development server

```bash
php artisan serve
```

Backend will be available at:

```
http://127.0.0.1:8000
```

## Default Admin Account

```
Email:    admin@uddn.edu
Password: password123
```

## API Endpoints

### Public

| Method | Endpoint                           | Description                       |
|--------|------------------------------------|-----------------------------------|
| POST   | `/api/login`                       | Authenticate user                 |
| GET    | `/api/weather/forecast`            | Weather (no auth — Open-Meteo)    |
| GET    | `/api/weather/geocode?city=Tagum`  | City geocoding (no auth)          |

### Protected (requires `Authorization: Bearer <token>`)

| Method | Endpoint                             | Description                         |
|--------|--------------------------------------|-------------------------------------|
| GET    | `/api/me`                            | Get authenticated user              |
| POST   | `/api/logout`                        | Revoke current token                |
| GET    | `/api/students`                      | List students (paginated, filtered) |
| GET    | `/api/students/{id}`                 | Get a single student                |
| GET    | `/api/courses`                       | List all courses with student count |
| GET    | `/api/dashboard/stats`               | Overall dashboard statistics        |
| GET    | `/api/dashboard/enrollment-trends`   | Monthly enrollment data             |
| GET    | `/api/dashboard/course-distribution` | Students per course                 |
| GET    | `/api/dashboard/attendance-patterns` | Daily attendance records            |
| GET    | `/api/dashboard/demographics`        | Gender, year level, city breakdown  |
| GET    | `/api/weather/forecast`              | Current conditions + 5-day forecast |
| GET    | `/api/weather/geocode?city=Tagum`    | Geocode a city name to lat/lon      |

### Student Query Filters

`GET /api/students` accepts the following optional query parameters:

| Parameter     | Type   | Description                              |
|---------------|--------|------------------------------------------|
| `school_year` | string | Filter by school year (e.g. `2025-2026`) |
| `course_id`   | int    | Filter by course ID                      |
| `year_level`  | int    | Filter by year level (1–4)               |
| `gender`      | string | Filter by gender (`Male`/`Female`)       |

## Sample Requests

### Login

```http
POST /api/login
Content-Type: application/json

{
  "email": "admin@uddn.edu",
  "password": "password123"
}
```

**Response:**

```json
{
  "message": "Login successful.",
  "token": "1|sampletoken...",
  "user": {
    "id": 1,
    "name": "Administrator",
    "email": "admin@uddn.edu"
  }
}
```

### Get Students (filtered)

```http
GET /api/students?school_year=2025-2026&year_level=1
Authorization: Bearer <token>
```
>>>>>>> 287a0a6 (Initial commit)
