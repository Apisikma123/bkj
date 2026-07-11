# SEO & Metadata Strategy

## Meta Tags
- Every page will have dynamic `title` and `description` meta tags.
- Fallback to global site name and description if not provided.

## Open Graph & Twitter Cards
- Add `og:title`, `og:description`, `og:image`, `og:url`, and `og:type` to all pages.
- Add `twitter:card` (summary_large_image), `twitter:title`, `twitter:description`, and `twitter:image`.

## Schema.org Structured Data (JSON-LD)
- **Organization Schema**: Applied to the Homepage.
- **LocalBusiness Schema**: Applied to Contact page and Subsidiary pages.
- **Article Schema**: Applied to Blog post pages.

## Sitemap & Robots
- Auto-generate `sitemap.xml` for all static pages, services, galleries, and blog posts.
- `robots.txt` will allow all crawlers but disallow `/admin`.
- Use canonical URLs to prevent duplicate content issues.
