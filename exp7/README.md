# PHP MySQL Auth App

Small PHP app with:

- User registration
- Session-based login
- Protected dashboard
- Logout

## Setup

1. Create the database and `users` table:

```sql
SOURCE schema.sql;
```

2. Update database credentials in `config.php` if needed.
   This project is currently configured for a local Homebrew MySQL instance on port `3308`
   using socket `/tmp/homebrew-mysql.sock`.

3. Start PHP's built-in server from this folder:

```bash
php -S localhost:8000
```

4. Open:

- `http://localhost:8000/register.php`
- `http://localhost:8000/login.php`
