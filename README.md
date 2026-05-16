## Technical Stack
- **Framework**: Laravel 10
- **Database**: MySQL / SQLite
- **Frontend**: Blade, Vanilla CSS, JavaScript
- **Auth**: Custom Authentication (Username/Email based)

## Installation

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

## Testing

The system includes an automated test suite that verifies all system requirements.

**Run the functional tests:**
```bash
php artisan test --filter SystemRequirementTest
```

## 👤 Credentials
- **Admin**: `admin` / `password` (Ensure you have an admin user in your database)
- **User**: Register via the web interface.

---
