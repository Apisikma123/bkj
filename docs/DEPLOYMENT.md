# Deployment Guide

## Server Requirements
- PHP 8.2+
- Composer 2.x
- Node.js & NPM (for frontend asset building)
- MySQL 8+ or PostgreSQL 14+
- Web Server (Nginx / Apache)

## Deployment Steps (VPS)

1. **Clone Repository**
   ```bash
   git clone https://github.com/... bkj-group
   cd bkj-group
   ```

2. **Install Dependencies**
   ```bash
   composer install --optimize-autoloader --no-dev
   npm install && npm run build
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Edit `.env` to configure DB credentials and APP_URL.*

4. **Database & Storage**
   ```bash
   php artisan migrate --force
   php artisan storage:link
   ```

5. **Optimization**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

6. **Permissions**
   Ensure `storage` and `bootstrap/cache` directories are writable by the web server (e.g., `www-data`).
