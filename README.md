# BookStore Online Bookstore System

BookStore is a modern, high-fidelity web application built with Laravel 10 for browsing, searching, and purchasing books. It features a sleek glassmorphism design, a robust shopping cart system, and comprehensive administrative tools.

## 🚀 Features

### For Users
- **Discovery**: Explore a curated collection of books on a stunning, responsive homepage.
- **Search & Filter**: Find books by title, author, or genre.
- **Shopping Cart**: Dynamic "Add to Cart" system with quantity management.
- **Secure Checkout**: Support for "Payment at Delivery" (COD) and Bank Transfers.
- **Order Tracking**: Monitor order statuses (Pending, Confirmed, Delivered, Rejected) in real-time.
- **Engagement**: Contact admin directly and learn more about us on dedicated pages.

### For Admins
- **Intelligence Dashboard**: Real-time stats on books, orders, users, and revenue.
- **Inventory Management**: Full CRUD for books and categories with image uploads.
- **Order Fulfillment**: Manage user orders and verify payment proofs.
- **User Insights**: View and manage the registered customer base.
- **Communication**: Access and respond to user messages via the Message Center.
- **Sales Intelligence**: Detailed reports on bookstore performance and top-selling titles.

## 🛠️ Technical Stack
- **Framework**: Laravel 10
- **Database**: MySQL / SQLite
- **Frontend**: Blade, Vanilla CSS (Glassmorphism Design System), JavaScript
- **Auth**: Custom Authentication (Username/Email based)

## 📦 Installation

1. **Clone the repository**:
   ```bash
   cd jwp-test
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment**:
   - Rename `.env.example` to `.env`.
   - Update your database credentials (`DB_DATABASE`, etc.).

4. **Initialize System**:
   ```bash
   php artisan key:generate
   php artisan migrate:fresh
   php artisan storage:link
   ```

5. **Launch Application**:
   ```bash
   php artisan serve
   ```

## 🧪 Testing

The system includes an automated test suite that verifies all system requirements.

**Run the functional tests:**
```bash
php artisan test --filter SystemRequirementTest
```

## 👤 Credentials
- **Admin**: `admin` / `password` (Ensure you have an admin user in your database)
- **User**: Register via the web interface.

---
