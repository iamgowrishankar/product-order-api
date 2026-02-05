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
### Method	        Endpoint	        Access
    GET	        /api/products	    Authenticated users
    POST	    /api/products	    Admin only
    PUT	        /api/products/{id}	Admin only
    DELETE	    /api/products/{id}	Admin only (soft delete)

### Orders
### Method	        Endpoint	        Access
    GET	        /api/orders	        Authenticated users
    POST	    /api/orders	        Authenticated users
    GET	        /api/orders/{id}	Order owner only

### Sample Test Cases

1. Login with valid admin credentials
2. Login with invalid passwords
5. Admin - creates a product
6. Admin - updatesAdmin -a product 
7. Admin - deletes a Admin -product
8. Admin - retrieves produAdmin -ct list
9. Customer - retrieves product list → products returned
10. Customer - create a product → unauthorized error
11. Customer - update a product → unauthorized error
12. Customer - delete a product → unauthorized error
13. Customer - creates order with sufficient stock → order created
14. Customer - creates order with insufficient stock → validation error
15. Customer - creates order with inactive product → error returned
16. Customer - retrieves own orders → only own orders returned
17. Customer - retrieves specific own order → order details returned
18. Customer 1 - creates an order
19. Customer 2 - attempts to view Customer 1’s order → unauthorized error
20. User logs out - token revoked
21. Access protected endpoint with expired token → unauthenticated error

### Test Data

### Create Sample Order:

{
  "items": [
    {
        "product_id": 1,
        "quantity": 10
    },
    {
        "product_id": 2,
        "quantity": 10
    }
  ]
}

### Create Sample Product:

{
  "name": "Mechanical Keyboard",
  "sku": "MK-2045",
  "price": 89.5,
  "stock_quantity": 40,
  "status": "inactive"
}


{
  "name": "Free Sticker",
  "sku": "STICKER-001",
  "price": 0,
  "stock_quantity": 0,
  "status": "active"
}