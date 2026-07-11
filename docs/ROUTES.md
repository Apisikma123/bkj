# Application Routes

## Public Frontend Routes (Web)
- `GET /` - Home
- `GET /about` - About Us
- `GET /services` - Services Listing
- `GET /services/{slug}` - Service Detail
- `GET /gallery` - Gallery
- `GET /blog` - Blog Listing
- `GET /blog/{slug}` - Blog Post Detail
- `GET /clients` - Clients
- `GET /contact` - Contact Us
- `GET /subsidiary/bintang-kepri-jaya` - PT Bintang Kepri Jaya
- `GET /subsidiary/batam-kepri-jaya` - PT Batam Kepri Jaya
- `GET /subsidiary/koperasi-tkbm` - Koperasi TKBM

## Language Switcher
- `GET /lang/{locale}` - Switches session locale between `id` and `en`

## Admin Panel (Filament)
- `GET /admin` - Dashboard
- `GET /admin/posts` - Manage Blog
- `GET /admin/services` - Manage Services
- `GET /admin/galleries` - Manage Gallery
- `GET /admin/clients` - Manage Clients
- `GET /admin/settings` - Manage Settings & Bank Accounts
