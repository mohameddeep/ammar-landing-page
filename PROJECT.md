# Ammar Landing Page

Bilingual marketing site and admin dashboard for a Saudi construction and licensing company (seeded brand: **البناء المتقدم** / **Advanced Building**). Visitors browse services, company information, and legal pages, then send a contact message or a pricing quote. Staff manage that content from an admin panel.

The database name in `.env.example` is `elryad`. The site title itself comes from the footer structure (`website_name`), not from a hardcoded brand in the layout.

---

## What the product does

### Public website

The site is Arabic and English, with right-to-left layout for Arabic. Every public page lives under a locale prefix (`/ar/...` and `/en/...`).

| Page | URL | What it shows |
| --- | --- | --- |
| Landing page | `/{locale}` | Hero slider, about section with statistics and tabs, services, pricing-quote call to action, contact form |
| Services list | `/{locale}/services` | Active services |
| Service detail | `/{locale}/services/{id}` | One service |
| About | `/{locale}/about-us` | About content and nested about blocks |
| Contact | `/{locale}/contact-us` | Contact page and the same contact form |
| Terms | `/{locale}/terms-and-conditions` | Terms HTML stored in structures |
| Privacy | `/{locale}/privacy-policy` | Privacy HTML stored in structures |
| Sitemap | `/sitemap.xml` | Locale pages plus each active service |
| Robots | `/robots.txt` | Crawl rules; respects `SEO_NOINDEX` |

Landing page sections, in order:

1. **Hero slider** — active sliders (three titles, body text, image).
2. **About** — title, description, and statistics from the `about` structure, plus active about-us tabs and their children.
3. **Services** — section heading from the `service` structure, then active service cards.
4. **Pricing quote** — modal form for a project quote.
5. **Contact** — name, email, phone, subject, message.
6. **Footer** — website name, logo, description, copyright, email, phone, WhatsApp, location, map link, and social links from the `footer` structure.

### Forms

Contact messages and pricing quotes are both saved in `contact_us`.

**Contact** (`POST /{locale}/contact`): name, email, phone, subject, message.

**Pricing quote** (`POST /{locale}/pricing-quote`): name, email, phone, one or more project types, project space, city, optional notes, and an optional file (image, PDF, or Word, up to 10 MB). Files are stored on the local disk under `pricing-quotes`.

Project types: residential building, commercial showrooms, villa, warehouses, tourism, hospital, hotel, other.

### Admin dashboard

Dashboard URLs are under `/{locale}/admin`. Login is session-based against the `managers` table.

| Area | Path | Actions |
| --- | --- | --- |
| Home | `/admin` | Counts of services, sliders, and contact messages |
| Profile | `/admin/admin-profile/{id}/edit` | Name, contact details, photo |
| Password | `POST /admin/update-password` | Change the logged-in manager password |
| Sliders | `/admin/sliders` | Create, edit, delete, toggle active |
| About blocks | `/admin/abouts` | Create, edit, delete, toggle; children under `/admin/abouts/{id}/children` |
| Services | `/admin/services` | Create, edit, delete, toggle active |
| Contacts | `/admin/dashboard/contacts` | List and delete submissions |
| Structures | `/admin/structures/...` | Edit about, services heading, terms, privacy, and footer as JSON content |

Seeded local admin (created by `ManagerSeeder`, role `super-admin`):

- Email: `admin@admin.com`
- Password: `123123123`

Change that password before any shared or production use.

Login page: `/{locale}/admin/auth/login`. Logout: `GET /{locale}/admin/auth/logout`.

---

## Tech stack

| Layer | Choice |
| --- | --- |
| Language | PHP 8.2+ |
| Framework | Laravel 12 |
| Database | MySQL (`DB_DATABASE=elryad` in `.env.example`) |
| Auth (dashboard) | Session guard `web`, provider `managers` |
| Roles | Laratrust (`super-admin`, `admin`, `store`, `designer`, `individual`) |
| API tokens | Laravel Sanctum and `tymon/jwt-auth` are installed. The website API file has a small JWT sign-in/sign-up stub; mobile and dashboard API route files are empty |
| Localization | `mcamara/laravel-localization`, locales `ar` and `en` |
| Frontend build | Vite 6, Tailwind CSS 4, Axios |
| Public pages | Blade templates, custom CSS in `resources/css/website.css` |
| Dashboard UI | Blade admin theme under `resources/views/dashboard`, Summernote editor component |
| Queues | Database driver |
| Mail | `log` mailer by default; OTP mail view exists at `resources/views/mails/send-otp.blade.php` |
| Debug | Laravel Telescope, Laravel Debugbar (dev), Laravel Pail |

Health check: `GET /up`.

---

## How a request is built

Public and dashboard pages follow the same path:

```
Route  →  Controller  →  Service  →  Repository  →  Eloquent model  →  Blade view
```

Repositories are bound in `app/Providers/RepositoryServiceProvider.php`.

| Interface | Implementation |
| --- | --- |
| `SliderRepositoryInterface` | `SliderRepository` |
| `ServiceRepositoryInterface` | `ServiceRepository` |
| `AboutUsRepositoryInterface` | `AboutUsRepository` |
| `StructureRepositoryInterface` | `StructureRepository` |
| `ContactUsRepositoryInterface` | `ContactUsRepository` |
| `ManagerRepositoryInterface` | `ManagerRepository` |
| `AdminProfileRepositoryInterface` | `AminProfileRepository` |
| `RoleRepositoryInterface` | `RoleRepository` |
| `PermissionRepositoryInterface` | `PermissionRepository` |

Bilingual columns use the `LanguageToggle` trait. Calling `$model->t('title')` reads `title_ar` or `title_en` for the current locale and falls back to the other language when the value is empty.

Page copy that is not a row in `services`, `sliders`, or `about_us` lives in `structures.content` as JSON. `App\Support\StructureContent` decodes that JSON. `App\Support\WebsiteMeta` builds titles, descriptions, canonical URLs, hreflang links, Open Graph tags, and JSON-LD.

Routes are registered in `bootstrap/app.php`:

- Local: website, dashboard, and `/api/v1/{website|mobile|dashboard}` on the same host.
- Production: API routes move to `PRODUCTION_API_SUBDOMAIN`. The dashboard route group is registered with the literal domain string `PRODUCTION_DASHBOARD_SUBDOMAIN` (it is not read from `env()`).

---

## Localization

Supported locales are `ar` (default regional `ar_AE`) and `en` (`en_GB`), configured in `config/laravellocalization.php`.

Middleware on web routes: `localeSessionRedirect`, `localizationRedirect`, `localeViewPath`.

Translation files:

- `lang/ar` and `lang/en`: `website.php`, `dashboard.php`, `landingpage.php`, `messages.php`, `validation.php`, `auth.php`, `pagination.php`
- English also has `passwords.php`

The HTML `dir` attribute is `rtl` for Arabic and `ltr` for English.

---

## SEO

Configured in `config/seo.php` and the website layout head.

| Variable | Effect |
| --- | --- |
| `SEO_NOINDEX` | When `true`, robots and meta robots become `noindex, nofollow` |
| `SEO_OG_IMAGE` | Default Open Graph image path |
| `SEO_TWITTER_SITE` | Twitter `site` handle |
| `SEO_JSON_LD` | Organization and WebSite JSON-LD. Default `true` |

Each page can override `@section('title')`, `meta_description`, `og_image`, `og_type`, and `robots`. The layout also emits canonical and `hreflang` alternates for `ar` and `en`.

---

## Database

Run migrations, then seeders. `DatabaseSeeder` calls Laratrust, managers, structures, about us, services, and sliders.

### `managers`

Dashboard users. Columns: `name`, unique `email`, unique `phone`, nullable `image`, `password` (hashed cast), `is_active`, remember token.

### `sliders`

Hero slides. `title_one_*`, `title_two_*`, `title_three_*`, `content_*` in Arabic and English, required `image`, `is_active`.

### `services`

`title_ar`, `title_en`, `content_ar`, `content_en`, `image`, `is_active`.

Seeded examples: building permits, demolition and restoration permits, construction completion certificates, and related engineering services.

### `about_us`

Self-related tree. `parent_id` points at another `about_us` row and cascades on delete. Same bilingual title/content fields, `image`, `is_active`. The public site loads active root rows and their active children as tabs.

### `structures`

One row per `key`, `content` stored as JSON.

| Key | Used for |
| --- | --- |
| `about` | Landing about title, description, statistics (value, name, icon) |
| `service` | Services section heading |
| `terms_and_conditions` | Terms page HTML (`desc`) |
| `privacy_policy` | Privacy page HTML (`content`) |
| `footer` | Website name, logo, blurb, copyright, phone, email, WhatsApp, location, map, social links |

### `contact_us`

`name`, `phone`, nullable `email`, nullable `subject`, `message`. Pricing-quote submissions are stored through the same model; the service layer writes the quote details into the message fields.

### Other tables

Laravel defaults: `users`, `cache`, `jobs`, `personal_access_tokens`. Laratrust: roles, permissions, and pivot tables. `otps` exists for one-time passwords. `users` is the JWT API provider and is not the dashboard login.

---

## Project layout

```
app/
  Http/Controllers/Website/     Public pages (landing, services, about, contact, terms, privacy, SEO)
  Http/Controllers/Dashboard/   Admin CRUD and structures
  Http/Services/                Business logic for website and dashboard
  Http/Requests/                Form validation
  Http/Traits/                  Language toggle, files, responses, notifications
  Http/Helpers/                 helpers.php, Http.php (autoloaded)
  Models/                       Service, Slider, AboutUs, Structure, ContactUs, Manager, Role, Permission, Otp
  Repository/                   Interfaces and Eloquent repositories
  Support/                      WebsiteMeta, StructureContent
  Providers/                    App, repository bindings, platform, Telescope
bootstrap/app.php               Routes, middleware aliases
config/                         app, auth, seo, localization, laratrust, jwt, sanctum, telescope
database/migrations/            Schema
database/seeders/               Demo content and admin user
lang/ar, lang/en                Translations
resources/views/website/        Public Blade views
resources/views/dashboard/      Admin Blade views
resources/views/components/     Form, buttons, cards, editor
resources/css/website.css       Public styles
routes/web.php                  Public site
routes/dashboard.php            Admin
routes/api.php                  Sanctum /user
routes/api/v1/                  website (stub auth), mobile (empty), dashboard (empty)
public/                         Web root, admin assets, icons
```

The repo also contains older scaffolding that the landing site does not use: order pipelines, product policy, Firebase job, complaint and order notifications, and several API resources under `app/Http/Resources/V1`. Those files are not wired to the public pages or the admin menu.

---

## Routes reference

### Public (`routes/web.php`)

```
GET  /sitemap.xml
GET  /robots.txt
GET  /{locale}/
GET  /{locale}/services
GET  /{locale}/services/{id}
GET  /{locale}/contact-us
POST /{locale}/contact
POST /{locale}/pricing-quote
GET  /{locale}/terms-and-conditions
GET  /{locale}/privacy-policy
GET  /{locale}/about-us
```

### Admin (`routes/dashboard.php`)

All of these sit under `/{locale}/admin` and, except login, require the `auth` middleware.

```
GET|POST  auth/login
GET       auth/logout
GET       /                         dashboard home
resource  admin-profile             edit, update
POST      update-password
resource  sliders                   except show, plus POST sliders/toggle/{id}
resource  abouts                    except show, plus POST abouts/toggle/{id}
resource  services                  except show, plus POST services/toggle/{id}
GET|POST  abouts/{id}/children
GET|PUT   abouts-children/{id}
resource  dashboard/contacts        index, destroy
structures/about, terms_and_conditions, footer, service_structure, policy
                                      index + store only
```

Role and manager controllers exist (`Dashboard\Roles\RoleController`, `Dashboard\Mangers\MangerController`) but are not registered in `routes/dashboard.php`, so they are not in the sidebar.

### API

`GET /api/user` returns the Sanctum user.

`routes/api/v1/website.php` exposes:

```
POST /api/v1/website/auth/sign/in
POST /api/v1/website/auth/sign/up
POST /api/v1/website/auth/sign/out   (auth:api)
GET  /api/v1/website/auth/what-is-my-platform
```

`mobile.php` and `dashboard.php` under `routes/api/v1` define no routes.

---

## Local setup

Requirements: PHP 8.2+, Composer, Node.js, MySQL.

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Create the MySQL database named in `DB_DATABASE`, then:

```bash
php artisan migrate
php artisan db:seed
npm install
npm run dev
```

Or run the app, queue listener, log tail, and Vite together:

```bash
composer dev
```

With Laragon, point the virtual host at the `public` directory. Set `APP_URL` to that host so canonical URLs, sitemap links, and asset URLs match.

Seeded admin: `http://localhost/{locale}/admin/auth/login` with `admin@admin.com` / `123123123`.

### Useful Artisan commands

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan queue:listen
php artisan test
./vendor/bin/pint
```

---

## Environment variables that matter

| Variable | Purpose |
| --- | --- |
| `APP_NAME`, `APP_URL`, `APP_ENV`, `APP_DEBUG`, `APP_KEY` | Application identity and URL |
| `APP_LOCALE`, `APP_FALLBACK_LOCALE` | Fallback locale (`en` in the example file). The site still offers `ar` and `en` through Laravel Localization |
| `DB_*` | MySQL connection. Example database name is `elryad` |
| `SESSION_*` | Dashboard login sessions (file driver, 120 minutes) |
| `QUEUE_CONNECTION` | `database` |
| `MAIL_*` | Outbound mail. Default mailer is `log` |
| `FILESYSTEM_DISK` | `local`. Pricing-quote uploads use the `local` disk explicitly |
| `SEO_NOINDEX`, `SEO_OG_IMAGE`, `SEO_TWITTER_SITE`, `SEO_JSON_LD` | Public SEO |
| `PRODUCTION_API_SUBDOMAIN` | Host for `/api/v1` when `APP_ENV=production` |

---

## Content model in short

- **Repeatable records** (sliders, services, about blocks) are normal tables with `_ar` / `_en` columns and an `is_active` flag. Only active rows are shown on the site.
- **Singleton page content** (about intro, service heading, terms, privacy, footer) is one JSON document per structure key, edited in the dashboard and read by the public services.
- **Messages** from both forms land in `contact_us` and are listed in the admin contacts screen.
