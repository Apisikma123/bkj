# Database Schema

## Entities and Relationships

### 1. `users`
- id, name, email, password, role, created_at, updated_at
- **Roles**: Super Admin, Editor

### 2. `posts` (Blog)
- id, title, slug, thumbnail, content, category_id, seo_title, seo_description, published_at, author_id, is_featured, status, views, created_at, updated_at
- **Relationships**: BelongsTo `User`, BelongsTo `Category`, BelongsToMany `Tag`

### 3. `categories` & `tags`
- id, name, slug

### 4. `services`
- id, title, slug, icon, short_description, full_description, is_active, order_column

### 5. `galleries`
- id, title, image_path, category, is_active, order_column

### 6. `clients`
- id, name, logo_path, website_url, is_active, order_column

### 7. `settings`
- id, key, value, type
- Used for global config: Phone, Email, WhatsApp, Social Links, Bank Accounts.

*Note: All tables will support Soft Deletes.*
