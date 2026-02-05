# Product & Order Management API

## Overview
This project is an API-first application built using Laravel for managing products and orders.

The application supports authentication using Laravel Sanctum and role-based authorization for product and order management.

---

## Tech Stack
- PHP 8.1+
- Laravel 10+
- MySQL / MariaDB
- Laravel Sanctum (API authentication)

---

## Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/iamgowrishankar/product-order-api.git
cd product-order-api
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup

Copy .env.example to .env and generate the application key:
```bash
php artisan key:generate
```

### 4. Run Migrations and Seeders
```bash
php artisan migrate --seed
```

### 5. Start the Application
```bash
php artisan serve
```

### API Endpoints

## Products
Method	        Endpoint	        Access
GET	        /api/products	    Authenticated users
POST	    /api/products	    Admin only
PUT	        /api/products/{id}	Admin only
DELETE	    /api/products/{id}	Admin only (soft delete)

### Orders
Method	        Endpoint	        Access
GET	        /api/orders	        Authenticated users
POST	    /api/orders	        Authenticated users
GET	        /api/orders/{id}	Order owner only