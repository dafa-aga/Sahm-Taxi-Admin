# Sahm Taxi Admin

Admin panel + public booking website for a taxi office (Sahm). Built with Laravel.

## Features

- **Services management**: create and manage taxi services.
- **Pricing per service**: manage prices linked to each service.
- **Orders/Bookings**:
  - public booking form (frontend)
  - admin orders list with status actions
  - **delivery price auto-fill** based on selected service (fetched from server)
  - payment method currently **cash only**
- **Drivers & complaints**: basic sections in the admin panel.

## Tech stack

- **Backend**: Laravel (PHP 8.2+)
- **Frontend tooling**: Vite (optional for local dev)
- **Database**: SQLite by default (easy local setup)

## Quick start (Windows / PowerShell)

From the project root:

```powershell
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

Then open:

- `http://127.0.0.1:8000`

## Notes

- **Default DB** is SQLite at `database/database.sqlite` (configured in `.env`).
- If Node.js is installed and you want hot-reload:

```powershell
npm install
npm run dev
```

## License

This project is provided as-is. You may add a license file if needed.
