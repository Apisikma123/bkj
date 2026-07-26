# BKJ Group (Batam Kepri Jaya)

**Live Website:** [bkjgrup.com](https://bkjgrup.com)

A comprehensive corporate web portal and Content Management System (CMS) built for Batam Kepri Jaya (BKJ Group). This platform provides a centralized, dynamic, and localized web presence for the company and its various subsidiaries, allowing administrators to manage content, news, services, and client portfolios effortlessly.

## Motivation and Architecture (The "Why")

The BKJ Group required a robust and scalable digital platform to consolidate its corporate identity and manage multiple subsidiary profiles under a single, unified system. The architectural goal was to build a secure, high-performance web application that delivers a premium user experience on the frontend while providing a flexible, structured CMS on the backend.

We chose the Laravel ecosystem for its powerful MVC architecture, built-in security features, and excellent developer experience. On the frontend, the integration of Tailwind CSS v4, Alpine.js, and GSAP ensures a highly responsive, modern, and animated interface without the overhead of heavy SPA frameworks. The application also implements dynamic asset handling (like subsidiary-specific favicons) and content localization to cater to a diverse audience.

## Tech Stack

**Backend**
- PHP 8.3
- Laravel 13 (MVC Framework)
- MySQL (Relational Database)

**Frontend**
- Tailwind CSS v4 (Utility-first styling)
- Alpine.js (Lightweight JavaScript behavior)
- GSAP & Lenis (Advanced animations and smooth scrolling)
- Splide (Accessible sliders)
- Vite (Next-generation frontend tooling)

**Key Packages & Integrations**
- Laravel Breeze (Authentication scaffolding)
- Spatie Media Library (File and image management)
- Spatie Sitemap (Automated SEO sitemap generation)
- Stichoza Google Translate PHP (Dynamic localization)

## Features

- **Dynamic Content Management:** Full admin control over core pages including Home, About, Gallery, Contact, and Offices.
- **Subsidiary Management:** Dedicated profiles, assets (icons/favicons), and content routing for individual BKJ Group subsidiaries.
- **News & Blog Center:** Integrated publishing platform for corporate announcements and industry news.
- **Localization:** Multi-language support (English and Indonesian) to serve both local and international stakeholders.
- **Role-Based Access Control:** Secure admin dashboard with Super Admin privileges for comprehensive user and role management.
- **Performance Optimized:** Leveraging Vite for asset bundling, caching strategies, and responsive image handling via Spatie Media Library.
- **SEO & Accessibility:** Automated sitemaps, semantic HTML, and optimized metadata for search engine visibility.

## Getting Started

### Prerequisites

Ensure your local development environment meets the following requirements:
- **PHP:** `^8.3`
- **Composer:** Latest stable version
- **Node.js & npm:** (v18+ recommended)
- **Database:** MySQL or MariaDB

### Installation

Follow these steps to set up the project locally:

1. **Clone the repository**
   ```bash
   git clone <your-repository-url>
   cd BKJ
   ```

2. **Run the setup script**
   The project includes a custom Composer script that handles dependencies, environment configuration, database migrations, and frontend builds in one command:
   ```bash
   composer setup
   ```
   *(Alternatively, you can manually run: `composer install`, copy `.env.example` to `.env`, generate the app key, migrate the database, and run `npm install && npm run build`)*

3. **Start the development server**
   You can use the built-in dev script to concurrently run the PHP server, Vite, and queue listener:
   ```bash
   composer dev
   ```

4. **Access the application**
   Visit `http://localhost:8000` in your browser. To access the admin dashboard, visit `/admin/dashboard` (you can generate default admin credentials by temporarily accessing the `/create-admin` route locally).

## Environment Variables

Copy the `.env.example` file to `.env` and configure the following key variables:

| Variable | Description | Example Value |
|----------|-------------|---------------|
| `APP_NAME` | The name of the application | `"BKJ Group"` |
| `APP_ENV` | The environment (local, production) | `local` |
| `APP_KEY` | Application encryption key | `base64:...` |
| `APP_DEBUG` | Enable/disable debug mode | `true` |
| `APP_URL` | The base URL of the application | `http://localhost:8000` |
| `DB_CONNECTION` | Database driver | `mysql` |
| `DB_DATABASE` | Database name | `bkj_group` |
| `DB_USERNAME` | Database user | `root` |
| `DB_PASSWORD` | Database password | `secret` |

## Project Structure

```text
├── app/
│   ├── Http/Controllers/   # Admin and frontend logic
│   └── Models/             # Eloquent data models (Subsidiary, Setting, etc.)
├── database/
│   ├── migrations/         # Database schema definitions
│   └── seeders/            # Initial CMS settings and demo data
├── public/                 # Publicly accessible assets and entry point
├── resources/
│   ├── views/              # Blade templates (frontend and admin)
│   ├── css/                # Tailwind CSS entry points
│   └── js/                 # Alpine.js, GSAP, and Vite configurations
├── routes/
│   ├── web.php             # Web, Admin, and Localization routes
│   └── auth.php            # Breeze authentication routes
```

## License and Author Information

**Author:** Aga Putra & The BKJ Group Development Team
**Contact:** admin@bkjgroup.com | agaputra62@gmail.com
**Website:** [bkjgrup.com](https://bkjgrup.com)

*For internal distribution and authorized contributors only.*