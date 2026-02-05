# Product & Order Management API

## Overview
This project is a API First Application built using Laravel for managing products and orders.

The application supports authentication using Laravel Sanctum and role-based authorization for product and order management.

## Tech Stack
- PHP 8.1+
- Laravel 10+
- MySQL / MariaDB
- Laravel Sanctum (API authentication)

## Setup Instructions

### 1. Clone the Repository

git clone <repository-url>
cd product-order-api

### 2. Install Dependencies

composer install

### 3. Env Setup

cp .env.example .env
php artisan key:generate

### 4. Run Migrations and Seeders

php artisan migrate --seed

### 5. Start the Application

php artisan serve

### API Endpoints

## Products
## Method	Endpoint	        Access
    GET	    /api/products	    Authenticated users
    POST	/api/products	    Admin only
    PUT	    /api/products/{id}	Admin only
    DELETE	/api/products/{id}	Admin only (soft delete)

## Orders
## Method	Endpoint	        Access
    GET	    /api/orders	        Authenticated users
    POST	/api/orders	        Authenticated users
    GET	    /api/orders/{id}	Order owner only