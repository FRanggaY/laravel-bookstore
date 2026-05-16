# 📖 Project Explanation: BookStore

This document provides a quick overview of how the application is structured and the essential commands you need to manage it.

## 🏗️ Core Architecture (MVC)

The application follows the **Model-View-Controller** pattern:

1.  **Routes** (`routes/web.php`): The entry point for all URLs. It maps requests to specific controller methods.
2.  **Controllers** (`app/Http/Controllers`):
    *   `AuthController`: Handles User registration, login, and logout.
    *   `HomeController`: Manages book discovery, search, and the About Us page.
    *   `CartController`: Handles the shopping cart logic (Add/Update/Remove).
    *   `UserOrderController`: Manages order placement, history, and payment proof uploads.
    *   `Admin/`: Contains controllers for administrative tasks (Category/Book CRUD, Order Management, Reports).
3.  **Models** (`app/Models`): Represent the database tables (`User`, `Category`, `Book`, `Order`, `Cart`, `Contact`) and their relationships.
4.  **Views** (`resources/views`): Blade templates for the frontend.
    *   `layouts/`: Shared structures (navigation, footer, styles).
    *   `admin/`: Pages restricted to the administrator.
    *   `books/`, `cart/`, `orders/`: Customer-facing pages.

---

## 📂 Key File Locations

| Purpose | Path |
| :--- | :--- |
| **Logic (Admin)** | `app/Http/Controllers/Admin/` |
| **Logic (User)** | `app/Http/Controllers/` |
| **Database Schema** | `database/migrations/` |
| **Upload Storage** | `public/storage/books/` |
| **Styles/CSS** | `resources/views/layouts/app.blade.php` |

---

## ⚡ Quick Laravel Commands

These are the exact commands used to build and manage this project:

### 1. Database & Migrations
*   `php artisan migrate` — Run pending migrations to create tables.
*   `php artisan migrate:fresh` — Wipe everything and reset with fresh tables.
*   `php artisan db:seed` — Run the database seeders.

### 2. Scaffold & Generation
*   `php artisan make:model Name` — Generate a new Eloquent model.
*   `php artisan make:controller NameController` — Create a new controller.
*   `php artisan storage:link` — **(Crucial)** Required to make uploaded book covers visible.

### 3. Testing & Validation
*   `php artisan test` — Run all tests in the system.
*   `php artisan test --filter SystemRequirementTest` — Run the functional requirement check.

### 4. Application & Server
*   `php artisan serve` — Launch the application at `http://127.0.0.1:8000`.
*   `php artisan key:generate` — Generate the application security key.

---

## 🛠️ Typical Workflow Example
To add a new feature:
1.  Add a route in `web.php`.
2.  Create/update a Controller method.
3.  Add/update a Model relationship if needed.
4.  Create the Blade view in `resources/views`.
