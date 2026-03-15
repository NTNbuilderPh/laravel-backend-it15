<div align="center">

# 🎓 UDDN Dashboard — Backend API

**Laravel 12 · PHP 8.2 · MySQL · Laravel Sanctum**

*RESTful API powering the University of Davao del Norte Academic Dashboard*
*School Year 2025–2026*

[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![Sanctum](https://img.shields.io/badge/Sanctum-4.0-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com/docs/sanctum)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)

</div>

---

## ✨ Features

| Feature | Details |
|---|---|
| 🔐 **Token Auth** | Laravel Sanctum — Bearer token login / logout |
| 🎓 **500 Students** | Seeded across 20 courses with realistic Davao del Norte data |
| 📚 **20 Courses** | Across 7 colleges — Computing, Business, Education, Engineering & more |
| 📅 **School Calendar** | Full SY 2025–2026 with holidays, events & attendance records |
| 📊 **Dashboard API** | Enrollment trends, course distribution, attendance patterns, demographics |
| 🌤️ **Weather Proxy** | Forwards requests to Open-Meteo — no API key required |
| ✅ **API Resources** | Consistent JSON shape on every response |
| 🛡️ **Form Validation** | `LoginRequest` with proper error messages |

---

## 🗂️ Project Structure

```
backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php       # login · me · logout
│   │   │   ├── CourseController.php     # list all courses
│   │   │   ├── DashboardController.php  # stats · trends · demographics
│   │   │   ├── StudentController.php    # paginated list · show
│   │   │   └── WeatherController.php    # forecast · geocode proxy
│   │   ├── Requests/
│   │   │   └── LoginRequest.php
│   │   └── Resources/
│   │       ├── CourseResource.php
│   │       └── StudentResource.php
│   ├── Models/
│   │   ├── Course.php
│   │   ├── SchoolDay.php
│   │   ├── Student.php
│   │   └── User.php
│   └── Providers/
│       └── AppServiceProvider.php
├── bootstrap/
│   └── app.php                          # Sanctum statefulApi() registered
├── config/
│   ├── cors.php                         # all local dev origins whitelisted
│   └── weather.php                      # Open-Meteo defaults (Tagum City)
├── database/
│   ├── migrations/                      # 6 migration files
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php               # admin@uddn.edu / password123
│       ├── CourseSeeder.php             # 20 courses
│       ├── StudentSeeder.php            # 500 students
│       └── SchoolDaySeeder.php          # Aug 2025 – May 2026 calendar
├── routes/
│   └── api.php
├── .env.example
└── composer.json
```

---

## 🚀 Quick Start

### 1 · Clone & install dependencies

```bash
git clone <repository-url>
cd backend
composer install
```

### 2 · Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uddn_dashboard
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3 · Run migrations and seed data

```bash
php artisan migrate:fresh --seed
```

> This creates all tables and seeds **500 students**, **20 courses**, a full **school calendar**, and the **admin account**.

### 4 · Start the development server

```bash
php artisan serve
```

API is now available at **`http://127.0.0.1:8000`**

---

## 🔑 Default Credentials

| Field | Value |
|---|---|
| Email | `admin@uddn.edu` |
| Password | `password123` |

---

## 📡 API Reference

### Public Endpoints

| Method | Endpoint | Description |
|---|---|---|
| `POST` | `/api/login` | Authenticate and receive a Bearer token |
| `GET` | `/api/weather/forecast` | Current weather + 6-day forecast (Open-Meteo) |
| `GET` | `/api/weather/geocode?city=Tagum` | Geocode a city name to coordinates |

### Protected Endpoints *(require `Authorization: Bearer <token>`)*

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/me` | Currently authenticated user |
| `POST` | `/api/logout` | Revoke current token |
| `GET` | `/api/students` | Paginated student list with filters |
| `GET` | `/api/students/{id}` | Single student record |
| `GET` | `/api/courses` | All courses with student count |
| `GET` | `/api/dashboard/stats` | Summary — total students, courses, school days, avg attendance |
| `GET` | `/api/dashboard/enrollment-trends` | Monthly enrollment counts |
| `GET` | `/api/dashboard/course-distribution` | Students per course |
| `GET` | `/api/dashboard/attendance-patterns` | Daily attendance records |
| `GET` | `/api/dashboard/demographics` | Gender · year level · city breakdown |

### Student Filters

Append any of these as query parameters to `GET /api/students`:

| Parameter | Type | Example |
|---|---|---|
| `school_year` | string | `?school_year=2025-2026` |
| `course_id` | integer | `?course_id=3` |
| `year_level` | string | `?year_level=1st Year` |
| `gender` | string | `?gender=Female` |

---

## 📬 Sample Requests

### Login

```http
POST /api/login
Content-Type: application/json

{
  "email": "admin@uddn.edu",
  "password": "password123"
}
```

**Response `200`**

```json
{
  "message": "Login successful.",
  "token": "1|abc123...",
  "user": {
    "id": 1,
    "name": "Administrator",
    "email": "admin@uddn.edu"
  }
}
```

### Dashboard Stats

```http
GET /api/dashboard/stats
Authorization: Bearer 1|abc123...
```

**Response `200`**

```json
{
  "school_year": "2025-2026",
  "total_students": 500,
  "total_courses": 20,
  "school_days": 183,
  "average_attendance": 412
}
```

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12 |
| Language | PHP 8.2+ |
| Authentication | Laravel Sanctum 4 |
| Database | MySQL 8 |
| ORM | Eloquent |
| Seeding | FakerPHP |
| Testing | PHPUnit 11 |

---

## 🐛 Known Fixes Applied

- **`SchoolDaySeeder`** — replaced Unicode smart quotes with ASCII apostrophes (was causing PHP parse errors)
- **`bootstrap/app.php`** — added `$middleware->statefulApi()` for correct Sanctum token handling
- **`config/cors.php`** — added `localhost:8000`, `localhost:5173`, and `localhost` to allowed origins

---

<div align="center">

*Part of the IT15/L Integrative Programming Final Project*
*University of Davao del Norte · SY 2025–2026*

</div>
